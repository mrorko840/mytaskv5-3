  <!-- footer-->
  <div class="footer">
      <div class="row no-gutters justify-content-center">
          <div class="col-auto">
              <a href="{{ route('home') }}" class="{{ request()->path() == 'user/dashboard' ? 'active jumpBtn' : '' }}">
                  <i class="material-icons">home</i>
                  <p>Dashboard</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.analytics') }}" class="{{ request()->path() == 'user/analytics' ? 'active jumpBtn' : '' }}">
                  <i class="material-icons">insert_chart_outline</i>
                  <p>Analytics</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('plans') }}" class="{{ request()->path() == 'plans' ? '' : '' }}">
                <div id="diamond" style="height: 56px; width: 56px; margin-top: -23px;" class="rounded-circle shadow d-flex align-items-center {{ request()->path() == 'plans' ? 'bg-orange-light text-orange jumpBtnMdl' : 'bg-ash-light text-ash' }}">
                    <i 
                        style="font-size: 30px; width: 40px;" 
                        class="material-icons">diamond</i>
                </div>
                
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.ptc.index') }}" class="{{ request()->path() == 'user/ptc' ? 'active jumpBtn' : '' }}">
                  <i class="material-icons">extension</i>
                  <p>Task</p>
              </a>
          </div>
          <div class="col-auto">
              <a href="{{ route('user.display_profile') }}" class="{{ request()->path() == 'user/display-profile' ? 'active jumpBtn' : '' }}">
                  <i class="material-icons">account_circle</i>
                  <p>Profile</p>
              </a>
          </div>
      </div>
  </div>

  <script>
    setInterval(() => {
        setTimeout(() => {
            $(".jumpBtn").attr('style', "margin-top: -5px; transition: ease all 0.5s; -webkit-transition: ease all 0.4s;");
        }, 900);
        $(".jumpBtn").attr('style', "margin-top: 0px; transition: ease all 0.5s; -webkit-transition: ease all 0.4s;");
    }, 1400);
  </script>
  <script>
    setInterval(() => {
        setTimeout(() => {
            $(".jumpBtnMdl").attr('style', "height: 56px; width: 56px; margin-top: -28px; transition: ease all 0.5s; -webkit-transition: ease all 0.4s;");
        }, 900);
        $(".jumpBtnMdl").attr('style', "height: 56px; width: 56px; margin-top: -23px; transition: ease all 0.5s; -webkit-transition: ease all 0.4s;");
    }, 1400);
  </script>
