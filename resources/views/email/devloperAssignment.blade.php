@component('mail::message')
<p align="center"><b>Complaint Assignment!</b></p>
{{ Helper::$dev_data['system_name'] }}<br>
<div style="padding: 10px; border : 1px solid #f2f2f2 ">
    <b>Compalint description</b><br>
    {!! Helper::$dev_data['description'] !!}<br><br>
    <b>Fault Type</b> : {{ Helper::$dev_data['fault_type'] }}<br>
    <b>Urgency Level</b> : {{ Helper::$dev_data['urgency_level'] }}<br><br>
    <b>Conctact Information</b><br>{!! Helper::getSenderDetails(Helper::$dev_data['client_id']) !!}<br>
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
<span class="break-all"><a href="http://127.0.0.1:8000/login">http://127.0.0.1:8000/login</a></span>

@endcomponent
