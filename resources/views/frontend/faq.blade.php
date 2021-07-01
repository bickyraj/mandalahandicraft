@extends('frontend.layouts.app')
@section('content')
<div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li><span>FAQ</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0 global-width">
            <div class="container">
                <div class="simple-filter js-simple-filter">
                    <div class="text-center">
                        <h2 class="h1-style">FAQ</h2>
                        <div class="simple-filter-tabs js-simple-filters-tabs">
                        	<span class="js-simple-filter-label" data-filter=".category1">TOP {{$faqs->count()}} Questions</span> 
                        	
                        </div>
                    </div>
                    <div class="faq-wrapper simple-filter-wrap">
                    	@foreach($faqs as $k=>$v)
                        <div class="faq-item js-simple-filter-item category1">
                            <div class="panel">
                                <div class="panel-heading"><a data-toggle="collapse" href="#faq{{$k}}" class="collapsed">
                                        <div class="panel-title">{{$v->question}}</div>
                                    </a></div>
                                <div id="faq{{$k}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       {!! $v->answer !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                   
              
                 
                      
                     
                   
              
                   
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection