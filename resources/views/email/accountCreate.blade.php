@component('mail::message')
<p align="center"><b>Welcome to Performance Monitoring and Fault Management System</b></p>

Your user account has been created successfully!<br>
Please use the following user credentials to access our system<br><br>
        <b>Username</b> : {{ Helper::$login_data['email'] }}<br>
        <b>Password</b> : {{ Helper::$login_data['password'] }}<br>



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
   
) <span class="break-all"><a href="http://127.0.0.1:8000/login">http://127.0.0.1:8000/login</a></span>


@endcomponent
