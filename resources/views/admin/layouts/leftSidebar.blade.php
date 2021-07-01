<div class="sidebar"
     data-active-color="rose"
     data-background-color="black"
     data-image="{{material_dashboard_url('img/sidebar-3.jpg')}}">

  {{--<div class="logo">
    <a href="{{ route('admin_home') }}" class="simple-text logo-mini">
      <i class="material-icons">dashboard</i>
    </a>
    <a href="{{ route('admin_home') }}" class="simple-text logo-normal">
      {{$company->name}}
    </a>
  </div>--}}
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{auth()->user()->image()}}"/>
      </div>
      <div class="info">
        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
          <span>
              {{auth()->user()->name}}
            <b class="caret"></b>
          </span>
        </a>
        <div class="clearfix"></div>
        <div class="collapse @if(request()->is('admin/user/'.auth()->id().'/edit') || request()->is('admin/my-profile')) in @endif"
             id="collapseExample">
          <ul class="nav">
            <li @if(request()->is('admin/my-profile')) class="active" @endif>
              <a href="{{route('user.profile')}}">
                <span class="sidebar-mini">&nbsp;</span>
                <span class="sidebar-normal">My Profile</span>
              </a>
            </li>
            <li @if(request()->is('admin/user/'.auth()->id().'/edit')) class="active" @endif>
              <a href="{{ route('user.edit', auth()->user()) }}">
                <span class="sidebar-mini">&nbsp;</span>
                <span class="sidebar-normal">Edit Profile</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="sidebar-mini">&nbsp;</span>
                <span class="sidebar-normal">Logout</span>
              </a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      @if(auth()->user()->hasRole('admin'))
        {{--company--}}
        <li @if(request()->is('admin/company/'.$company->id.'/edit')) class="active" @endif>
          <a href="{{ route('company.edit',$company->id) }}">
            <i class="material-icons">account_balance</i>
            <p>Company</p>
          </a>
        </li>
        {{--./company--}}

        {{--notification--}}
        <!-- <li @if(request()->is('admin/notification*')) class="active" @endif>
          <a href="{{ route('notification.index') }}">
            <i class="material-icons">notifications</i>
            <p>{{ ucwords('push notifications') }}</p>
          </a>
        </li> -->
        {{--./notification--}}


        

        {{--user--}}
        <li @if(request()->is('admin/user*')) class="active" @endif>
          <a data-toggle="collapse" href="#user">
            <i class="material-icons">person</i>
            <p>{{ ucfirst('user') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse @if(request()->is('admin/user*')) in @endif" id="user">
            <ul class="nav">
              <li @if(request()->is('admin/user')) class="active" @endif>
                <a href="{{ route('user.index') }}">
                  <span class="sidebar-mini">&nbsp;</span>
                  <!-- <i class="material-icons">spellcheck</i> -->
                  <span class="sidebar-normal">All {{ ucfirst(str_plural('user')) }}</span>
                </a>
              </li>
              <li @if(request()->is('admin/user/create')) class="active" @endif>
                <a href="{{ route('user.create') }}">
                  <span class="sidebar-mini">&nbsp;</span>
                  <span class="sidebar-normal">New {{ ucfirst('user') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        {{--./user--}}





        {{--category--}}
        <li @if(request()->is('admin/category*') || request()->is('admin/sub-category*')) class="active" @endif>
          <a data-toggle="collapse" href="#category">
            <i class="material-icons">layers</i>
            <p>{{ ucfirst('category') }}<b class="caret"></b></p>
          </a>
          <div class="collapse @if(request()->is('admin/category*') || request()->is('admin/sub-category*')) in @endif"
               id="category">
            <ul class="nav">
              <li @if(request()->is('admin/category')) class="active" @endif>
                <a href="{{route('category.index')}}">
                  <span class="sidebar-mini">&nbsp;</span>
                  <span class="sidebar-normal">All {{ ucfirst(str_plural('category')) }}</span>
                </a>
              </li>
              <li @if(request()->is('admin/category/create')) class="active" @endif>
                <a href="{{route('category.create')}}">
                  <span class="sidebar-mini">&nbsp;</span>
                  <span class="sidebar-normal">New {{ ucfirst('category') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        {{--./category--}}

        {{--color--}}
        <li @if(request()->is('admin/color*')) class="active" @endif>
          <a href="{{ route('color.index') }}">
            <i class="material-icons">invert_colors</i>
            <p>{{ ucwords('Manage Color') }}</p>
          </a>
        </li>
        {{--./color--}}


        {{--brand--}}
        <li @if(request()->is('admin/brands*')) class="active" @endif>
          <a href="{{ route('brands.index') }}">
            <i class="material-icons">games</i>
            <p>{{ ucwords('Manage Brands') }}</p>
          </a>
        </li>
        {{--./brand--}}
        
        <li @if(request()->is('admin/groups*')) class="active" @endif>
          <a data-toggle="collapse" href="#groups">
            <i class="material-icons">list</i>
            <p>Size Group
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse @if(request()->is('admin/groups*')) in @endif" id="groups">
            <ul class="nav">
              <li @if(request()->is('admin/groups')) class="active" @endif>
                <a href="{{ route('groups.index') }}">
                  <span class="sidebar-mini">&nbsp;</span>
                  <!-- <i class="material-icons">spellcheck</i> -->
                  <span class="sidebar-normal">All Group</span>
                </a>
              </li>
              <li @if(request()->is('admin/groups/create')) class="active" @endif>
                <a href="{{ route('groups.create') }}">
                  <span class="sidebar-mini">&nbsp;</span>
                  <span class="sidebar-normal">New Group</span>
                </a>
              </li>
            </ul>
          </div>
        </li>



        @endif



        {{--order--}}
        <li @if(request()->is('admin/order*')) class="active" @endif>
          <a href="{{ route('order.index') }}">
            <i class="fa fa-shopping-cart"></i>
            <p>{{ ucwords('orders') }}</p>
          </a>
        </li>
        {{--./order--}}

@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('vendor'))
        {{--product--}}
        <li @if(request()->is('admin/product*')) class="active" @endif>
          <a data-toggle="collapse" href="#product">
           <i class="fa fa-shopping-bag"></i>
            <p>{{ ucfirst('product') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse @if(request()->is('admin/product*')) in @endif" id="product">
            <ul class="nav">
              <li @if(request()->is('admin/product')) class="active" @endif>
                <a href="{{ route('product.index') }}">
                  <span class="sidebar-mini">A</span>
                  <span class="sidebar-normal">All {{ ucfirst(str_plural('product')) }}</span>
                </a>
              </li>
              <li @if(request()->is('admin/product/create')) class="active" @endif>
                <a href="{{ route('product.create') }}">
                  <span class="sidebar-mini">N</span>
                  <span class="sidebar-normal">New {{ ucfirst('product') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        {{--./product--}}
  @endif

  @if(auth()->user()->hasRole('admin'))

  {{--news--}}
  <li @if(request()->is('admin/news*')) class="active" @endif>
    <a data-toggle="collapse" href="#news">
      <i class="material-icons">dvr</i>
      <p>{{ ucfirst('news') }} & Updates
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @if(request()->is('admin/news*')) in @endif" id="news">
      <ul class="nav">
        <li @if(request()->is('admin/news')) class="active" @endif>
          <a href="{{ route('news.index') }}">
            <span class="sidebar-mini">&nbsp;</span>
            <span class="sidebar-normal">All {{ ucfirst(str_plural('news')) }}</span>
          </a>
        </li>
        <li @if(request()->is('admin/news/create')) class="active" @endif>
          <a href="{{ route('news.create') }}">
            <span class="sidebar-mini">&nbsp;</span>
            <span class="sidebar-normal">New {{ ucfirst('news') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  {{--./news--}}


  {{--slider--}}
  <li @if(request()->is('admin/slider*')) class="active" @endif>
    <a data-toggle="collapse" href="#slider">
      <i class="fa fa-picture-o" aria-hidden="true"></i>
      <p>{{ ucfirst('slider') }}
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @if(request()->is('admin/slider*')) in @endif" id="slider">
      <ul class="nav">
        <li @if(request()->is('admin/slider')) class="active" @endif>
          <a href="{{ route('slider.index') }}">
            <span class="sidebar-mini">&nbsp;</span>
            {{--<i class="material-icons">spellcheck</i>--}}
            <span class="sidebar-normal">All {{ ucfirst(str_plural('slider')) }}</span>
          </a>
        </li>
        <li @if(request()->is('admin/slider/create')) class="active" @endif>
          <a href="{{ route('slider.create') }}">
            <span class="sidebar-mini">&nbsp;</span>
            {{--<i class="material-icons">add_circle_outline</i>--}}
            <span class="sidebar-normal">New {{ ucfirst('slider') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  {{--./slider--}}



  {{--advertisement--}}
  <li @if(request()->is('admin/advertisement*')) class="active" @endif>
    <a data-toggle="collapse" href="#advertisement">
      <i class="material-icons">nfc</i>
      <p>{{ ucfirst('advertisement') }}
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @if(request()->is('admin/advertisement*')) in @endif" id="advertisement">
      <ul class="nav">
        <li @if(request()->is('admin/advertisement')) class="active" @endif>
          <a href="{{ route('advertisement.index') }}">
            <span class="sidebar-mini">&nbsp;</span>
            {{--<i class="material-icons">spellcheck</i>--}}
            <span class="sidebar-normal">All {{ ucfirst(str_plural('advertisement')) }}</span>
          </a>
        </li>
        <li @if(request()->is('admin/advertisement/create')) class="active" @endif>
          <a href="{{ route('advertisement.create') }}">
            <span class="sidebar-mini">&nbsp;</span>
            {{--<i class="material-icons">add_circle_outline</i>--}}
            <span class="sidebar-normal">New {{ ucfirst('advertisement') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  {{--./advertisement--}}


  {{--subscriber--}}
  <li @if(request()->is('admin/subscribers')) class="active" @endif>
    <a href="{{ route('admin.subscriber') }}">
      <i class="material-icons">people_outline</i>
      <p>Subscribers</p>
    </a>
  </li>
  {{--./subscriber--}}

  {{--faq--}}
  <li @if(request()->is('admin/faq*')) class="active" @endif>
    <a href="{{ route('faq.index') }}">
     <i class="fa fa-question-circle" aria-hidden="true"></i>
      <p>Faqs</p>
    </a>
  </li>
  {{--./faq--}}




  @endif

        

      

      

        

        


      

     

    </ul>
  </div>
</div>