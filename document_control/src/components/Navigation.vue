<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
            <div class="form-inline">
                <i class="mdi mdi-menu mdi-24px d-block d-lg-none pointer text-dark mr-2" id="menu"></i>
                <a class="navbar-brand" href="#">
                    Document Control
                </a>
            </div>
            <div class="dropdown ml-auto">
                <a id="dropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="#" class="avatar rounded-circle" width="25">
                </a>
                <div class="dropdown-menu dropdown-menu-right rounded" aria-labelledby="dropdownMenu">
                    <div class="text-center my-3 px-3 text-break">
                        <img src="#" class="avatar rounded-circle" width="75">
                        <h6 class="name text-truncate pt-3 mb-0"></h6>
                        <!-- <small class="level text-secondary"></small> -->
                    </div>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item {{Request::is('profil')?'active':''}}" href="{{url('profil')}}">
                        <i class="mdi mdi-18px mdi-account-box-outline"></i><span>Profil</span>
                    </a>
                    <a class="dropdown-item {{Request::is('ubah-password')?'active':''}}" href="{{url('ubah-password')}}">
                        <i class="mdi mdi-18px mdi-lock-outline"></i><span>Ubah Password</span>
                    </a> -->
                    <a class="dropdown-item" id="logout" role="button">
                        <i class="mdi mdi-18px mdi-login-variant"></i><span>Logout</span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="sidebar">
            <small class="text-secondary text-uppercase font-weight-bold">Menu</small>
            <router-link to="/dashboard">
                <i class="mdi mdi-apps mdi-18px"></i><span>Dashboard</span>
            </router-link>
        </div>
        <div class="overlay"></div>
    </div>
</template>

<script>
export default {
    name: 'Navigation'
}
</script>

<style>

</style>