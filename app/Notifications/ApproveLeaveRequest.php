<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ApproveLeaveRequest extends Notification
{
    use Queueable;

    public $leave_request;
    public function __construct(LeaveRequest $leave_request)
    {
        //

        $this->leave_request = $leave_request;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }

    public function toMail($notifiable)
    {

            $leave_name=$this->leave_request->leave_type->name;

        return (new MailMessage)
            ->subject('Approve Leave Request')
            ->line('You are to review and approve a leave request, '.$leave_name.' applied for by '.$this->leave_request->user->name)
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
        $leave_name=$this->leave_request->leave_type->name;
        return new DatabaseMessage([
            'subject'=>'Approve Leave Request-' .$leave_name,
            'details'=>"<ul class=\"list-group list-group-bordered\">
                  <li class=\"list-group-item \"><strong>Employee Name:</strong><span style\"text-align:right\">".$this->leave_request->user->name."</span></li>
                  <li class=\"list-group-item  \"><strong>Leave Type:</strong><span style\"text-align:right\">".$leave_name."</span></li>
                  <li class=\"list-group-item \"><strong>Start Date:</strong><span style\"text-align:right\">".date("F j, Y", strtotime($this->leave_request->start_date))."</span></li>
                  <li class=\"list-group-item \"><strong>End Date:</strong><span style\"text-align:right\">".date("F j, Y", strtotime($this->leave_request->end_date))."</span></li>
                  <li class=\"list-group-item \"><strong>Reason:</strong><span style\"text-align:right\">".$this->leave_request->reason."</span></li>
                </ul>",
            'message'=>'You are to review and approve a leave request '.$leave_name.' applied for by '.$this->leave_request->user->name,
            // 'action'=>route('documents.showreview', ['id'=>$this->document->id]),
            'type'=>'Leave Request',
            'icon'=>'ni-calendar-check-fill',
             'color'=>'warning'
        ]);

    }
}
