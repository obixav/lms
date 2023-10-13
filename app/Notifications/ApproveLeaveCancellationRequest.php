<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use App\Models\LeaveRequestCancellation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ApproveLeaveCancellationRequest extends Notification
{
    use Queueable;

    public LeaveRequestCancellation $leave_request_cancellation;
    public function __construct(LeaveRequestCancellation $leave_request_cancellation)
    {
        //

        $this->leave_request_cancellation = $leave_request_cancellation;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }

    public function toMail($notifiable)
    {

            $leave_name=$this->leave_request_cancellation->leave_request->leave_type->name;

        return (new MailMessage)
            ->subject('Approve Leave Request Cancellation')
            ->line('You are to review and approve a leave request cancellation, for '.$leave_name.' initiated  by '.$this->leave_request_cancellation->initiator->name)
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    public function toDatabase($notifiable)
    {
        $leave_name=$this->leave_request_cancellation->leave_request->leave_type->name;
        return new DatabaseMessage([
            'subject'=>'Approve Leave Request Cancellation-' .$leave_name,
            'details'=>"<ul class=\"list-group list-group-bordered\">
                  <li class=\"list-group-item \"><strong>Employee Name:</strong><span style\"text-align:right\">".$this->leave_request_cancellation->leave_request->user->name."</span></li>
                  <li class=\"list-group-item  \"><strong>Leave Type:</strong><span style\"text-align:right\">".$leave_name."</span></li>
                  <li class=\"list-group-item \"><strong>Start Date:</strong><span style\"text-align:right\">".date("F j, Y", strtotime($this->leave_request_cancellation->leave_request->start_date))."</span></li>
                  <li class=\"list-group-item \"><strong>End Date:</strong><span style\"text-align:right\">".date("F j, Y", strtotime($this->leave_request_cancellation->leave_request->end_date))."</span></li>
                  <li class=\"list-group-item \"><strong>Reason:</strong><span style\"text-align:right\">".$this->leave_request_cancellation->reason."</span></li>
                </ul>",
            'message'=>'You are to review and approve a leave request cancellation '.$leave_name.' applied  by '.$this->leave_request_cancellation->initiator->name,
            // 'action'=>route('documents.showreview', ['id'=>$this->document->id]),
            'type'=>'Leave Request Cancellation',
            'icon'=>'ni-calendar-check-fill',
             'color'=>'warning'
        ]);

    }
}
