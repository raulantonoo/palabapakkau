@extends('layouts_user.app')

@section('content')
<style>
    .card-box {
        border: 1px solid #ddd;
        padding: 20px;
        /* box-shadow: 0px 0px 10px 0px #c5c5c5; */
        /* margin-bottom: 30px; */
        /* float: left; */
        border-radius: 200px;
        -moz-border-radius: 200px;

    }

    .card-box .card-thumbnail {
        overflow: hidden;
        border-radius: 200px;
        transition: 1s;
        /* max-width: 200px; */
        -moz-border-radius: 200px;
    }

    .card-box .card-thumbnail:hover {
        transform: scale(1.5);
    }

    .card-box h3 a {
        /* font-size: 20px; */
        text-decoration: none;
    }

    /* ////// */

    .box-bg {
        background-color: #fff;
        /* padding: 15px 15px; */
        /* border: 2px solid #e2e2e2; */
        /* border-top-left-radius: 40px;
        border-bottom-right-radius: 40px; */
        position: relative;
        /* margin: 15px 0px; */
        overflow: hidden;
    }

    .social-links {
        width: 100%;
        position: absolute;
        top: -150px;
        left: 0px;
        background-color: rgba(0, 0, 0, 0.6);
        height: 30%;
        padding: 5px 0px;
        transition: 1s;
    }

    .box-bg:hover .social-links {
        top: 0px;
    }

    .social-links ul {
        padding: 0px;
        margin: 0px;
    }

    .social-links ul li {
        list-style: none;
        float: left;
        width: 100%;
    }

    .social-links ul li a {
        text-align: center;
        display: block;
        color: #607D8B;
        margin: 1% auto;
        text-decoration: none;
        color: white;
    }

    .social-links ul li a:hover {
        font-size: 20px;
        color: #997950;
    }

    .social-links h4 {
        color: #fff;
        /* padding-bottom: 15px; */
    }


    /* lllll */

    /* section.our-team {
        padding: 70px 0px;
        background-color: #f2f9ff;
        text-align: center;
        color: #fff;
    } */
    .member {
        text-align: center;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
        transition: 0.4s;
        /* border-radius: 100%;
        border: 6px solid #ffffff; */
    }

    /* .our-team h2 {
        font-size: 36px;
        color: #795548;
        font-weight: normal;
    }

    .our-team p {
        color: #9e9e9e;
        width: 70%;
        margin: 10px auto 10px;
    } */

    .member:hover {
        box-shadow: 0px 10px 0px 0px #795548;
    }

    .member .member-info {
        position: absolute;
        bottom: 0;
        top: 0;
        left: 0;
        right: 0;
        opacity: 0;
    }

    .member .member-detail {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 10px;
    }

    .member .social {
        position: absolute;
        left: 0;
        bottom: -38px;
        right: 0;
        height: 48px;
        transition: bottom ease-in-out 0.4s;
        text-align: center;
    }

    .member .social a {
        margin: 0 10px;
        display: inline-block;
        color: white;
    }

    .member .social a:hover {
        /* color: #795548; */
        color: #43270f;
    }



    .member .social i {
        font-size: 18px;
        margin: 0 2px;
    }

    .member:hover .member-info {
        background: linear-gradient(0deg, rgba(0, 0, 0, 0.83) 0%, rgba(0, 0, 0, 0.57) 20%, rgba(121, 85, 72, 0.09) 100%);
        opacity: 1;
        transition: 0.4s;
    }

    .member:hover .member-detail {
        bottom: 80px;
    }

    .member:hover .social {
        bottom: 10px;
    }

    .btn:hover {
        background-color: black;
    }

    table tbody tr th {
        padding: 3%;
        width: 150px;
    }
</style>


<div class="container" style="margin-top:6%">
    <div class="card ">
        <nav pt-3 style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:black">Profil</li>
            </ol>
        </nav>

        <div class="card mt-1 mb-2">
            <div class="  row mt-2 mb-2" style="margin:auto">
                <h3><b>Welcome {{$user->name}} </b></h3>

            </div>
            <div class="ml-2 mt-2 mb-4 mr-2">

                <h5>Kelola informasi pribadi anda untuk melakukan perbelanjaan dengan nyaman dan tenang</h5>
            </div>

            <div class="row justify-content-center m-1">
                <div class="col-sm-8 col-md-6 col-lg-3">
                    <!-- Bootstrap 5 card box -->
                    <div class="box-bg m-auto mb-3 mt-4">
                        <!-- Bootstrap 5 card box -->
                        @if(!empty($user->photo))
                        <div class="card-box m-auto  rounded-circle">
                            <div class="card-thumbnail m-auto" style="border:0px">
                                <img src="{{ url('/image/'.$user->photo) }}" style="margin:1%;height:230px" class="img-fluid rounded-circle" alt="">
                            </div>
                        </div>
                        @else
                        <div class="card-box m-auto  rounded-circle">
                            <div class="card-thumbnail m-auto" style="border:0px">
                                <img src="{{ asset('../images/profil.png') }}" style="margin:1%;" class="img-fluid rounded-circle" alt="">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-9 col-md-8 col-lg-7">
                    <!-- Bootstrap 5 card box -->
                    <div class="mb-3">
                        <div class="card-box  border-0 text-left">
                            <!-- <div class="member-detail"> -->
                            <table>
                                <tbody>

                                    <tr>
                                        <th>Nama</th>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir </th>
                                        <td>{{$user->tmp_lahir}}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{$user->tgl_lahir}}</td>
                                    </tr>
                                    <tr>
                                        <th>No Handphone </th>
                                        <td>{{$user->no_hp}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{$user->jns_kelamin}}</td>
                                    </tr>

                                    </tr>
                                </tbody>
                            </table>
                            <a href="/user_edit/{{ $user->id }}" class="btn btn-outline-success">Edit Profil</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection