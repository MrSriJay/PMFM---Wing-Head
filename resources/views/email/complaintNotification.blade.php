@component('mail::message')
<p align="center"><b>Fault reported to {{ Helper::$complaint_data['system_name'] }}</b></p>

A complaint has been reported by {{ Helper::$complaint_data['client_name'] }} for {{ Helper::$complaint_data['system_name'] }}, the system was developed by {!! Helper::getWingName(Helper::$complaint_data['wing_id']) !!} of CDRD. <br>
<div style="padding: 10px; border : 1px solid #f2f2f2 ">
    <b>Compalint description</b><br>
    {!! Helper::$complaint_data['description'] !!}<br><br>
    <b>Fault Type</b> : {{ Helper::$complaint_data['fault_type'] }}<br>
    <b>Urgency Level</b> : {{ Helper::$complaint_data['urgency_level'] }}<br><br>
    <b>Conctact Information</b><br>{!! Helper::getSenderDetails(Helper::$complaint_data['client_id']) !!}<br>
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
   
) <span class="break-all"><a href="http://pmfm.crd.lk/login">http://pmfm.crd.lk/login</a></span>

@endcomponent
