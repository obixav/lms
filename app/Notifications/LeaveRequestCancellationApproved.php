<?php

namespace App\Notifications;

use App\Models\Approval;
use App\Models\WorkflowStage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;


class LeaveRequestCancellationApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $stage;
    public $leave_cancellation_approval;
    public function __construct(WorkflowStage $stage,Approval $leave_cancellation_approval)
    {
        //
        $this->stage=$stage;
        $this->leave_cancellation_approval=$leave_cancellation_approval;
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
        $leave_name=$this->leave_cancellation_approval->approvable->leave_request->leave_type->name;


        return (new MailMessage)
            ->subject('Leave Request Cancellation Approved')
            ->line('The leave request cancellation , for'.$leave_name.' which '.$this->leave_cancellation_approval->approvable->leave_request->user->name.' submitted for approval on the '.date('Y-m-d',strtotime($this->leave_cancellation_approval->approvable->created_at)).'('.\Carbon\Carbon::parse($this->leave_cancellation_approval->approvable->created_at)->diffForHumans().') has been approved at the final stage')
            ->line('Your leave balance is '.getLeaveBalance($this->leave_cancellation_approval->approvable->leave_request->user_id,$this->leave_cancellation_approval->approvable->leave_request->leave_type_id))
            ->action('View Leave Request', url("my_leave_requests"))
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
        $leave_name=$this->leave_cancellation_approval->approvable->leave_request->leave_type->name;
        return new DatabaseMessage([
            'subject'=>$leave_name.' -Leave Request Approved',
            'message'=>'The leave request, '.$leave_name.' which '.$this->leave_cancellation_approval->approvable->leave_request->user->name.' submitted for approval on the '.date('Y-m-d',strtotime($this->leave_cancellation_approval->approvable->created_at)).' ('.\Carbon\Carbon::parse($this->leave_cancellation_approval->approvable->created_at)->diffForHumans().') has been approved at the final stage.<br> Your leave balance is '.getLeaveBalance($this->leave_cancellation_approval->approvable->leave_request->user_id,$this->leave_cancellation_approval->approvable->leave_request->leave_type_id),
            'action'=>url("my_leave_requests"),
            'type'=>'LeaveRequestCancellation',
            'icon'=>'ni-calendar-check-fill',
            'color'=>'success'

        ]);

    }
}
