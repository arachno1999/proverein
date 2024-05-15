<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('website_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/artikels*") ? "menu-open" : "" }} {{ request()->is("admin/webmenus*") ? "menu-open" : "" }} {{ request()->is("admin/submenus*") ? "menu-open" : "" }} {{ request()->is("admin/templates*") ? "menu-open" : "" }} {{ request()->is("admin/images*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/artikels*") ? "active" : "" }} {{ request()->is("admin/webmenus*") ? "active" : "" }} {{ request()->is("admin/submenus*") ? "active" : "" }} {{ request()->is("admin/templates*") ? "active" : "" }} {{ request()->is("admin/images*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-rss">

                            </i>
                            <p>
                                {{ trans('cruds.website.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('artikel_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.artikels.index") }}" class="nav-link {{ request()->is("admin/artikels") || request()->is("admin/artikels/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.artikel.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('webmenu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.webmenus.index") }}" class="nav-link {{ request()->is("admin/webmenus") || request()->is("admin/webmenus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-ellipsis-h">

                                        </i>
                                        <p>
                                            {{ trans('cruds.webmenu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('submenu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.submenus.index") }}" class="nav-link {{ request()->is("admin/submenus") || request()->is("admin/submenus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-subway">

                                        </i>
                                        <p>
                                            {{ trans('cruds.submenu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('template_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.templates.index") }}" class="nav-link {{ request()->is("admin/templates") || request()->is("admin/templates/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-stamp">

                                        </i>
                                        <p>
                                            {{ trans('cruds.template.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('image_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.images.index") }}" class="nav-link {{ request()->is("admin/images") || request()->is("admin/images/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-images">

                                        </i>
                                        <p>
                                            {{ trans('cruds.image.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('finance_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/finanzens*") ? "menu-open" : "" }} {{ request()->is("admin/finanzkategoriens*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/finanzens*") ? "active" : "" }} {{ request()->is("admin/finanzkategoriens*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-hand-holding-usd">

                            </i>
                            <p>
                                {{ trans('cruds.finance.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('finanzen_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.finanzens.index") }}" class="nav-link {{ request()->is("admin/finanzens") || request()->is("admin/finanzens/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.finanzen.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('finanzkategorien_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.finanzkategoriens.index") }}" class="nav-link {{ request()->is("admin/finanzkategoriens") || request()->is("admin/finanzkategoriens/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.finanzkategorien.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('mitglied_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.mitglieds.index") }}" class="nav-link {{ request()->is("admin/mitglieds") || request()->is("admin/mitglieds/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.mitglied.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('aktion_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.aktions.index") }}" class="nav-link {{ request()->is("admin/aktions") || request()->is("admin/aktions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bolt">

                            </i>
                            <p>
                                {{ trans('cruds.aktion.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('veranstaltung_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.veranstaltungs.index") }}" class="nav-link {{ request()->is("admin/veranstaltungs") || request()->is("admin/veranstaltungs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.veranstaltung.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('satzung_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.satzungs.index") }}" class="nav-link {{ request()->is("admin/satzungs") || request()->is("admin/satzungs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-balance-scale">

                            </i>
                            <p>
                                {{ trans('cruds.satzung.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('admin_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/mitglieds-typs*") ? "menu-open" : "" }} {{ request()->is("admin/organes*") ? "menu-open" : "" }} {{ request()->is("admin/orts*") ? "menu-open" : "" }} {{ request()->is("admin/tags*") ? "menu-open" : "" }} {{ request()->is("admin/textes*") ? "menu-open" : "" }} {{ request()->is("admin/counters*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/mitglieds-typs*") ? "active" : "" }} {{ request()->is("admin/organes*") ? "active" : "" }} {{ request()->is("admin/orts*") ? "active" : "" }} {{ request()->is("admin/tags*") ? "active" : "" }} {{ request()->is("admin/textes*") ? "active" : "" }} {{ request()->is("admin/counters*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.admin.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('mitglieds_typ_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.mitglieds-typs.index") }}" class="nav-link {{ request()->is("admin/mitglieds-typs") || request()->is("admin/mitglieds-typs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.mitgliedsTyp.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('organe_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.organes.index") }}" class="nav-link {{ request()->is("admin/organes") || request()->is("admin/organes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-heart">

                                        </i>
                                        <p>
                                            {{ trans('cruds.organe.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('ort_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.orts.index") }}" class="nav-link {{ request()->is("admin/orts") || request()->is("admin/orts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ort.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tags.index") }}" class="nav-link {{ request()->is("admin/tags") || request()->is("admin/tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.tag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('texte_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.textes.index") }}" class="nav-link {{ request()->is("admin/textes") || request()->is("admin/textes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.texte.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('counter_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.counters.index") }}" class="nav-link {{ request()->is("admin/counters") || request()->is("admin/counters/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chart-bar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.counter.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('verein_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.vereins.index") }}" class="nav-link {{ request()->is("admin/vereins") || request()->is("admin/vereins/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-crown">

                            </i>
                            <p>
                                {{ trans('cruds.verein.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('verein_single_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.verein-singles.index") }}" class="nav-link {{ request()->is("admin/verein-singles") || request()->is("admin/verein-singles/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-crown">

                            </i>
                            <p>
                                {{ trans('cruds.vereinSingle.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('help_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-ncs*") ? "menu-open" : "" }} {{ request()->is("admin/howto-ncs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/faq-ncs*") ? "active" : "" }} {{ request()->is("admin/howto-ncs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-ambulance">

                            </i>
                            <p>
                                {{ trans('cruds.help.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_nc_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-ncs.index") }}" class="nav-link {{ request()->is("admin/faq-ncs") || request()->is("admin/faq-ncs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqNc.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('howto_nc_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.howto-ncs.index") }}" class="nav-link {{ request()->is("admin/howto-ncs") || request()->is("admin/howto-ncs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.howtoNc.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/teams*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.team.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('hilf_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/howtos*") ? "menu-open" : "" }} {{ request()->is("admin/faqs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/howtos*") ? "active" : "" }} {{ request()->is("admin/faqs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-medkit">

                            </i>
                            <p>
                                {{ trans('cruds.hilf.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('howto_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.howtos.index") }}" class="nav-link {{ request()->is("admin/howtos") || request()->is("admin/howtos/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.howto.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faqs.index") }}" class="nav-link {{ request()->is("admin/faqs") || request()->is("admin/faqs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faq.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                    <li class="nav-item">
                        <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                            <i class="fa-fw fa fa-users nav-icon">
                            </i>
                            <p>
                                {{ trans("global.team-members") }}
                            </p>
                        </a>
                    </li>
                @endif
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>