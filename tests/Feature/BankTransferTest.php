<?php

namespace Tests\Feature;

use App\Mail\BankTransferNotificationMail;
use App\Models\BankTransferRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BankTransferTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'mail.from.address' => 'osl@opticoresolutionsltd.com',
            'shares.hotels' => [
                'jana' => ['name' => 'Hotel Jana', 'name_bn' => 'হোটেল জানা', 'price' => 300000, 'max' => 10],
                'dove' => ['name' => 'Hotel Jana The Dove', 'name_bn' => 'হোটেল জানা দ্য ডাভ', 'price' => 40000, 'max' => 5],
            ],
        ]);
    }

    public function test_notify_queues_internal_email_with_customer_and_order_details(): void
    {
        Mail::fake();

        $this->postJson('/bank-transfer/notify', [
            'name' => 'Test Customer',
            'phone' => '+8801700000000',
            'email' => 'customer@example.com',
            'address_1' => 'House 1, Road 2',
            'address_2' => 'Dhaka',
            'shares' => ['jana' => 1, 'dove' => 2],
            'terms_accepted' => true,
        ])->assertOk()->assertJson(['ok' => true]);

        Mail::assertQueued(BankTransferNotificationMail::class, function (BankTransferNotificationMail $mail) {
            return $mail->hasTo('osl@opticoresolutionsltd.com')
                && $mail->name === 'Test Customer'
                && $mail->phone === '+8801700000000'
                && $mail->email === 'customer@example.com'
                && $mail->addressLine1 === 'House 1, Road 2'
                && $mail->addressLine2 === 'Dhaka'
                && $mail->total === 380000.0;
        });

        // Saved for the CMS, where an admin marks it paid once the money arrives.
        $booking = BankTransferRequest::sole();
        $this->assertSame('New', $booking->status);
        $this->assertSame('customer@example.com', $booking->email);
        $this->assertEquals(380000, $booking->total);
        $this->assertCount(2, $booking->lines);
    }

    public function test_notify_does_not_require_address_line_two(): void
    {
        Mail::fake();

        $this->postJson('/bank-transfer/notify', [
            'name' => 'Test Customer',
            'phone' => '+8801700000000',
            'email' => 'customer@example.com',
            'address_1' => 'House 1, Road 2',
            'shares' => ['jana' => 1],
            'terms_accepted' => true,
        ])->assertOk();

        Mail::assertQueued(BankTransferNotificationMail::class, fn (BankTransferNotificationMail $mail) => $mail->addressLine2 === null);
    }

    public function test_notify_validates_required_fields(): void
    {
        Mail::fake();

        $this->postJson('/bank-transfer/notify', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'phone', 'email', 'address_1', 'shares', 'terms_accepted']);

        Mail::assertNothingQueued();
    }

    public function test_notify_requires_agreement_to_the_terms(): void
    {
        Mail::fake();

        $this->postJson('/bank-transfer/notify', [
            'name' => 'Test Customer',
            'phone' => '+8801700000000',
            'email' => 'customer@example.com',
            'address_1' => 'House 1, Road 2',
            'shares' => ['jana' => 1],
            'terms_accepted' => false,
        ])->assertStatus(422)->assertJsonValidationErrors(['terms_accepted']);

        Mail::assertNothingQueued();
    }

    public function test_notify_rejects_invalid_share_selection(): void
    {
        Mail::fake();

        $this->postJson('/bank-transfer/notify', [
            'name' => 'Test Customer',
            'phone' => '+8801700000000',
            'email' => 'customer@example.com',
            'address_1' => 'House 1, Road 2',
            'shares' => ['unknown' => 1],
            'terms_accepted' => true,
        ])->assertStatus(422);

        Mail::assertNothingQueued();
    }
}
