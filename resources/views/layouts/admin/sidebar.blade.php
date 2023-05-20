<!--**********************************
            Sidebar start
        ***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">

                <a href="{{ route('admin.home') }}"><img src="{{ URL::asset('/images/BT.png') }}" alt=""></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> BlackTop</h5>
            <p class="email">{{ Auth::user()->email }}</p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>

            <li><a href="{{ route('admin.home') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-077-menu-1"></i>
                    <span class="nav-text">Dashboard Map</span>
                </a>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-141-home"></i>
                    <span class="nav-text">Students</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('students.index') }}">Students List</a></li>
                    <li><a href="{{ route('students.create') }}">Add Student</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-141-home"></i>
                    <span class="nav-text">Student Marks</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('marks.index') }}">Student Marks List</a></li>
                    <li><a href="{{ route('marks.create') }}">Add Student Marks</a></li>
                </ul>
            </li>
           

            <li class="nav-label">Settings</li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">

                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Settings</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">Pages</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('pages.index') }}">Pages List</a></li>
                            <li><a href="{{ route('pages.create') }}">Add Page</a></li>
                        </ul>

                </ul>
            </li>
        </ul>
        <div class="copyright">
        </div>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
