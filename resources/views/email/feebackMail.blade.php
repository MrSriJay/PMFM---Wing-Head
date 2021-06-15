@component('mail::message')
<p align="center"><b>New Message!</b></p>
<div>
    You have new message from {!! Helper::$feedback_message['sender'] !!} - <i>{!! Helper::getDesignation(Helper::$feedback_message['usertype']) !!}</i>
    <br>
    <small><a href="http://127.0.0.1:8000/login">View Message</a></small>
</div>
<br>
@lang('Regards'),<br>
    <b>Performance Monitoring & Fault Management System</b> <br>
    <small style="margin-top:-10px">Center for Defence Research & Development, Ministry for National Security</small>
    <br>
    <small style="margin-top:-10px"><i>Mahenawaththa,Moragahahena Road, Pitipana, Homagama</i></small>
    <br>
    <small style="margin-top:-10px"><i>Tel : 011-3173491 / 077-3929482</i></small>
    <br>
    <small style="margin-top:-10px"><i>Fax : 011-2182175</i></small>
    <br>
    <small style="margin-top:-10px"><i>Email : hq@crd.lk / hqcrdmod@gmail.com</i></small>
<br>
{{-- Subcopy --}}
<hr>
@lang(
    "If you’re having trouble, copy and paste the URL below\n".
    'into your web browser:',
   
)
<span class="break-all"><a href="http://pmfm.crd.lk/login">http://pmfm.crd.lk/login</a></span>
@endcomponent
