<nav class="navbar navbar-default navbar-static-top mb-0 p-0">
    <div class="navbar-header" style="background: rgb(3, 19, 109);max-height:60px">
        <div class="top-left-part">
            <!-- Logo -->
            
            <a class="logo" href="{{url('/')}}">
               <b style="color: black;font-weight: 600;"> Alfatawa-alhanafia</b>
            </a>
        </div>
        <!-- /Logo -->
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li> </li>
            <li> </li>
            <admin-search></admin-search>
            <li>
                <a style="color:white" class="profile-pic" href="#"> <b class="hidden-xs">{{auth()->user()->name}}</b></a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>