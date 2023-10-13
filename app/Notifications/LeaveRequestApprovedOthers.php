<?php

namespace App\Notifications;

use App\Models\Approval;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;


class LeaveRequestApprovedOthers extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $leave_approval;
    public function __construct(Approval $leave_approval)
    {
        //

        $this->leave_approval=$leave_approval;
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
            ->subject('Leave Request Approved')
            ->line('The leave request, '.$leave_name.' which was submitted by '.$this->leave_approval->approvable->user->name.' for approval on the '.date('Y-m-d',strtotime($this->leave_approval->approvable->created_at)).'('.\Carbon\Carbon::parse($this->leave_approval->approvable->created_at)->diffForHumans().') has been approved at the final approval stage')
            ->line('They are to start the leave on '.date('F j,Y',strtotime($this->leave_approval->approvable->start_date)).' and end on '.date('F j,Y',strtotime($this->leave_approval->approvable->end_date)))

            // ->action('View Leave Request', url("leave/myrequests"))
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
            'subject'=>$leave_name.' -Leave Request Approved',
            'message'=>'The leave request, '.$leave_name.' which was submitted by '.$this->leave_approval->approvable->user->name.' for approval on the '.date('Y-m-d',strtotime($this->leave_approval->stage->workflow->name)).'('.\Carbon\Carbon::parse($this->leave_approval->approvable->created_at)->diffForHumans().') has been approved at the final stage.<br> Their leave balance is '.$this->leave_approval->approvable->balance.'
            <br> They are to start the leave on '.date('F j,Y',strtotime($this->leave_approval->approvable->start_date)).' and end on '.date('F j,Y',strtotime($this->leave_approval->approvable->end_date)),
            'action'=>'#',
            'type'=>'LeaveRequest',
            'icon'=>'ni-calendar-check-fill',
            'color'=>'success'
        ]);

    }
}
