<div class="project-view_wrap">
    <div class="container">
      <div class="col-left">
        <header>
        <h1 class="logo-wrap"><img src="images/Q-logo-white.png" alt="Q LTD logo" class="logo"></h1>
        <div class="tagline-wrap">
          <div class="dash-mark"></div>
          <p class="tagline"><strong>Breakthrough Creative</strong><br />Since 1981</p>
        </div>
        <hr>
        <ul class="contact-list">
          <li><a href="mailto:insa@qltd.com"><i class="fa fa-envelope"></i> Insa Keilbach</a></li>
          <li><a href="mailto:mike@qltd.com"><i class="fa fa-envelope"></i> Mike Bondra</a></li>
          <li><a href="mailto:christine@qltd.com"> <i class="fa fa-envelope"></i> Christine Golus</a></li>
          <li><a href="mailto:amy@qltd.com"><i class="fa fa-envelope"></i> Amy Mayer</a></li>
        </ul>
        </header>
      </div>
      <div class="col-right">
        <main>
          <h1>{{$project->name}}</h1>
            @foreach($comps as $comp)
              <hr>
              <section class="file-group">
                <span class="date">May 21, 2014</span>
               <!-- <h2>Website Refinements</h2>-->
                <ul class="assets-list">
                  <li>v1: <a href="#">Desktop</a></li>
                  <li>v1: <a href="#">Desktop with submenu</a></li>
                  <li>v1: <a href="#">Tablet</a></li>
                  <li>v1: <a href="#">Mobile</a></li>
                  <li>v1: <a href="#">Mobile with submenu</a></li>
                </ul>
              </section>
            @endforeach
        </main>
      </div>
    </div> 
</div>

