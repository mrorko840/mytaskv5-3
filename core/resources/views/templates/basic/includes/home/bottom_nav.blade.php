  <!-- footer-->
  <div class="footer">
      <div class="row no-gutters justify-content-center">
          <div class="col-auto">
              <a href="{{ route('home') }}" class="{{ request()->path() == '/' ? 'active' : '' }}">
                  <i class="material-icons">home</i>
                  <p>Home</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.analytics') }}" class="{{ request()->path() == 'user/analytics' ? 'active' : '' }}">
                  <i class="material-icons">insert_chart_outline</i>
                  <p>Analytics</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('plans') }}" class="{{ request()->path() == 'plans' ? '' : '' }}">
                <div style="height: 56px; width: 56px; margin-top: -23px;" class="rounded-circle shadow d-flex align-items-center {{ request()->path() == 'plans' ? 'bg-orange-light text-orange' : 'bg-default-light text-default' }}">
                    <i style="font-size: 30px; width: 40px;" class="material-icons">diamond</i>
                </div>
                
              </a>
          </div>
          <div class="col-auto">
              <a href="{{route('user.register')}}" class="{{ request()->path() == 'user/ptc' ? 'active' : '' }}">
                  <i class="material-icons">person_add_alt</i>
                  <p>Sign-Up</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{route('user.login')}}" class="{{ request()->path() == 'user/display-profile' ? 'active' : '' }}">
                  <i class="material-icons">login</i>
                  <p>Login</p>
              </a>
          </div>
      </div>
  </div>
