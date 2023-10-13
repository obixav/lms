<?php

namespace App\Notifications;

use App\Models\Approval;
use App\Models\WorkflowStage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LeaveRequestPassedStage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $leave_approval;
    public $stage;
    public $nextstage;
    public function __construct(Approval $leave_approval,WorkflowStage $stage,WorkflowStage $nextstage)
    {
        //
        $this->leave_approval=$leave_approval;
        $this->stage=$stage;
        $this->nextstage=$nextstage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $leave_name=$this->leave_approval->approvable->leave_type->name;
        return (new MailMessage)
            ->subject('Leave request Passed an Approval Stage')
            ->line('The leave request, '.$leave_name.' which you submitted for approval has been approved at the '.$this->stage->name.' by '.$this->leave_approval->approver->name)
            ->line('It has been moved to the'.$this->nextstage->name)
            ->action('View Leave Request',  url("my_leave_requests"))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {

        $leave_name=$this->leave_approval->approvable->leave_type->name;
        return new DatabaseMessage([
            'subject'=>$leave_name.' -Leave Request Passed an Approval Stage',
            'message'=>'The, '.$leave_name.' request which you submitted for approval has been approved at the '.$this->stage->name.' by '.$this->leave_approval->approver->name,
            'action'=>url("my_leave_requests"),
            'type'=>'LeaveRequest',
            'icon'=>'ni-calendar-check-fill',
            'color'=>'success'
        ]);

    }
}
