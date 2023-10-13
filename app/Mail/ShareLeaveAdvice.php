<?php

namespace App\Mail;

use App\Models\LeaveRequest;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Barryvdh\DomPDF\Facade\Pdf;

class ShareLeaveAdvice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $leave_request_id=0;
    public function __construct($leave_request_id)
    {
        $this->leave_request_id = $leave_request_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Share Leave Advice',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $leave_request=LeaveRequest::find($this->leave_request_id);
        $setting=Setting::first();
        $approvals=$leave_request->approvals;
        return new Content(
            view: 'emails.leave_advice_email',
           with: ['leave_request'=>$leave_request,
                'setting'=>$setting,
                'approvals'=>$approvals]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $leave_request=LeaveRequest::find($this->leave_request_id);
        $opciones_ssl=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $setting=Setting::first();
        $extencion = pathinfo(public_path('admin_assets/images/logo.png'), PATHINFO_EXTENSION);
        $img_base_64= base64_encode(file_get_contents(public_path('admin_assets/images/logo.png'),false, stream_context_create($opciones_ssl)));
        $image = 'data:image/' . $extencion . ';base64,' . $img_base_64;

        $approvals=$leave_request->approvals;
        if ($leave_request->status===1) {
            $pdf = PDF::loadView('admin.leave_requests.partials.leave_advice', compact('leave_request','setting','approvals','image')); //load view page
//            return $this->view('emails.leave_advice_email',compact('leave_request','setting','approvals'))
//                ->attachData($pdf->stream(), $leave_request->user->name.' leave-advice.pdf', [
//                    'mime' => 'application/pdf',
//                ]);

        return [
            Attachment::fromData(fn () => $pdf->stream(), $leave_request->user->name.' leave-advice.pdf')

                ->withMime('application/pdf'),
        ];
        }
        return [];
    }
}
