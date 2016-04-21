@extends('layouts.app')

@section('content')
<div class="project-view_wrap">
    <div class="container">
      <div class="col-left">
        <header>
        <h1 class="logo-wrap"><img src="/images/Q-logo-white.png" alt="Q LTD logo" class="logo"></h1>
        <div class="tagline-wrap">
          <div class="dash-mark"></div>
          <p class="tagline"><strong>Breakthrough Creative</strong><br />Since 1981</p>
        </div>
        <hr>
        <ul class="contact-list">
        <!--  <li><a href="mailto:insa@qltd.com"><i class="fa fa-envelope"></i> Insa Keilbach</a></li>-->
        </ul>
        </header>
      </div>
      <div class="col-right">
        <main>
          <h1>{{$project_name}}</h1>
            {{--*/ $display_date = '' /*--}}
            @foreach($comps as $comp)
               @if($display_date != $comp->display_date) 
                  <hr>
               @endif
              <section class="file-group">
               @if($display_date != $comp->display_date) 
                    <h2><span class="date">{{$comp->display_date}}</span></h2>
                    {{--*/ $display_date = $comp->display_date /*--}}
               @endif
               <!-- <h2>Website Refinements</h2>-->
                <ul class="assets-list">
                  <li><a href="/view/comp/{{$comp->id}}">{{$comp->title}}</a></li>
                </ul>
              </section>
            @endforeach
        </main>
      </div>
    </div> 
</div>

