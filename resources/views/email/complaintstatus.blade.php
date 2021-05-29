@component('mail::message')

    <p align="center"><b>Complaint Update!</b></p>
    Dear {!! Helper::$status_message['client_name'] !!}, <br>
           {!! Helper::$status_message['message'] !!}
    <br><br>
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
    <hr>
    @lang(
        "If you’re having trouble, copy and paste the URL below\n".
        'into your web browser:',
    
    )
    <span class="break-all"><a href="http://127.0.0.1:8000/login">http://127.0.0.1:8000/login</a></span>
@endcomponent
