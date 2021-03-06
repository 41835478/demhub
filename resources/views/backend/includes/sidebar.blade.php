          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

				<?php /*
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel">
                <div class="pull-left image">
                  <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                  <p>{{ access()->user()->name }}</p>
                  <!-- Status -->
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>


              <!-- search form (Optional) -->
              <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.search_placeholder') }}"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </form>
              <!-- /.search form -->
 				*/ ?>

              <!-- Sidebar Menu -->
              <ul class="sidebar-menu">
                <li class="header">{{ trans('menus.general') }}</li>

                <!-- Optionally, you can add icons to the links -->
                <li class="{{ Active::pattern('admin/dashboard') }}"><a href="{!!route('backend.dashboard')!!}"><span>{{ trans('menus.dashboard') }}</span></a></li>
                <li class="{{ Active::pattern('admin/articles') }}"><a href="{!!route('backend.articles')!!}"><span>Articles</span></a></li>
                <li class="{{ Active::pattern('admin/keywords') }}"><a href="{!!route('backend.keywords')!!}"><span>Keywords</span></a></li>
                <li class="{{ Active::pattern('admin/sources') }}"><a href="{!!route('backend.sources')!!}"><span>Scrape sources</span></a></li>
                <li class="{{ Active::pattern('admin/reports') }}"><a href="{!!route('backend.reports')!!}"><span>Reports</span></a></li>
                <li class="{{ Active::pattern('admin/signup') }}"><a href="{!!route('backend.signup')!!}"><span>Signup Email Blast</span></a></li>
                <li class="{{ Active::pattern('admin/betaInvite') }}"><a href="{!!route('backend.potentialusersinvites')!!}"><span>Potential Users Invites</span></a></li>
                <li class="{{ Active::pattern('admin/betaInvite') }}"><a href="{!!route('backend.betainvites')!!}"><span>Beta Invites</span></a></li>
                <li class="{{ Active::pattern('admin/reengageEmail') }}"><a href="{!!route('backend.reengageEmail')!!}"><span>Send Reengagement Email</span></a></li>
                <li class="{{ Active::pattern('admin/scripts') }}"><a href="{!!route('backend.scripts')!!}"><span>Run Scripts</span></a></li>

				  <?php /*
                @permission('view-access-management')
                  <li class="{{ Active::pattern('admin/access/*') }}"><a href="{!!url('admin/access/users')!!}"><span>{{ trans('menus.access_management') }}</span></a></li>
                @endauth

                 <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                  <a href="#">
                    <span>{{ trans('menus.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                      <a href="{!! url('admin/log-viewer') !!}">{{ trans('menus.log-viewer.dashboard') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                      <a href="{!! url('admin/log-viewer/logs') !!}">{{ trans('menus.log-viewer.logs') }}</a>
                    </li>
                  </ul>
                </li>
 				*/ ?>

              </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
          </aside>
