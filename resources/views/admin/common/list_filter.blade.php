@if(isset($list_filters) && count($list_filters) > 0)
<div class="page-header">
    <div class="row align-items-end">

        <div class="col-md-12 col-sm-12 col-xs-12" @if(!$show_filters) style="display:none;" @endif>
            <div class="x_panel card">
                <div class="x_title">
                    <h5 class="heading">List Filters</h5>
                    <ul class=" navbar-right panel_toolbox">
                        <li style="float:right;" id="show-filter"><a class="collapse-link" style="color:#C5C7CB"><i class="show-filter fa fa-chevron-down"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content hide" id="list_filter">

                    <form id="list_filter_form" method="GET" novalidate="true" onsubmit="return false;">
                        <div class="form-group row">

                            @foreach($list_filters as $filter)
                            @if($filter['type'] == 'hidden')
                            <input id="{{$filter['name']}}" type="hidden" name="{{$filter['name']}}" value="{{$filter['value']}}" />
                            @else
                            <div class="col-sm-6 col-md-4 mb-2 mb-sm-3 @if(isset($filter['group_class'])) {{$filter['group_class']}} @endif">
                                <label class="col-form-label">{{$filter['label']}}</label>
                                @if ($filter['type'] == 'text' || $filter['type'] == 'date')
                                <input id="{{$filter['name']}}" type="{{$filter['type']}}" name="{{$filter['name']}}" class="form-control @if(isset($filter['class'])) {{$filter['class']}} @endif" value="@if(isset($filter['value'])) {{$filter['value']}} @endif" @if(isset($filter['js'])) {!! $filter['js'] !!} @endif />
                                @elseif($filter['type'] == 'select')
                                @if(isset($filter['multiple']) && $filter['multiple'] == true)
                                <select name="{{$filter['name']}}[]" id="{{$filter['name']}}" class="form-control @if(isset($filter['class'])) {{$filter['class']}} @endif" @if(isset($filter['multiple'])) multiple="multiple" @endif @if(isset($filter['js'])) {!! $filter['js'] !!} @endif>
                                    @else
                                    <select name="{{$filter['name']}}" id="{{$filter['name']}}" class="form-control @if(isset($filter['class'])) {{$filter['class']}} @endif" @if(isset($filter['js'])) {!! $filter['js'] !!} @endif>
                                        @endif
                                        <option value="">Select {{$filter['label']}}</option>
                                        @if(isset($filter['options']) && count($filter['options']) > 0)
                                        @foreach($filter['options'] as $o_key => $o_value)
                                        <option value="{{$o_key}}" @if(isset($filter['value']) && $filter['value']==$o_key) selected="selected" @endif>{{$o_value}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @elseif($filter['type'] == 'date')
                                    <input id="{{$filter['name']}}" type="text" name="{{$filter['name']}}" class="hasdatepicker form-control @if(isset($filter['class'])) {{$filter['class']}} @endif" value="@if(isset($filter['value'])) {{$filter['value']}} @endif" @if(isset($filter['js'])) {!! $filter['js'] !!} @endif />
                                    @else
                                    <input id="{{$filter['name']}}" type="text" name="{{$filter['name']}}" class="form-control @if(isset($filter['class'])) {{$filter['class']}} @endif" value="@if(isset($filter['value'])) {{$filter['value']}} @endif" @if(isset($filter['js'])) {!! $filter['js'] !!} @endif />
                                    @endif
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 mt-4 text-center text-sm-left form-btns">
                            <button type="reset" class="btn btn-warning resetbtn" onclick="resetFilters(this)">Reset</button>
                            <button type="button" class="btn btn-info searchbtn" onclick="filterList(this)">Search</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .panel_toolbox {
        float: right;
        min-width: 70px
    }

    .panel_toolbox>li {
        float: left;
        cursor: pointer
    }

    .panel_toolbox>li>a {
        padding: 5px;
        color: #C5C7CB;
        font-size: 14px
    }

    .panel_toolbox>li>a:hover {
        /*    background: #F5F7FA*/
    }

    .x_panel {
        position: relative;
        width: 100%;
        margin-bottom: 10px;
        padding: 10px 17px;
        display: inline-block;
        background: #fff;
        border: 1px solid #E6E9ED;
        -webkit-column-break-inside: avoid;
        -moz-column-break-inside: avoid;
        column-break-inside: avoid;
        opacity: 1;
        transition: all .2s ease
    }

    .x_title {
        border-bottom: 2px solid #E6E9ED;
        padding: 1px 5px 6px;
        margin-bottom: 10px
    }

    .x_title .filter {
        width: 40%;
        float: right
    }

    .x_title h2 {
        margin: 5px 0 6px;
        float: left;
        display: block;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap
    }

    .x_title h2 small {
        margin-left: 10px
    }

    .x_title span {
        color: #BDBDBD
    }

    .x_content {
        padding: 0 5px 6px;
        position: relative;
        width: 100%;
        float: left;
        clear: both;
        margin-top: 5px
    }

    .x_content h4 {
        font-size: 16px;
        font-weight: 500
    }

    .x_title h1,
    .x_title h2,
    .x_title h3,
    .x_title h4,
    .x_title h5 {
        float: left;
        display: block;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        margin: 0;
        margin-right: 15px;
    }

    .x_title .panel_toolbox>li>a {
        color: #fff;
        font-size: 12px
    }

    .auto-width {
        min-width: inherit;
    }

    .x_title .panel_toolbox>li>a.default {
        padding: 5px;
        color: #C5C7CB;
        font-size: 14px;
    }

    .x_title .panel_toolbox>li>a.btn-default {
        color: #333;
    }

    .x_title .badge {
        color: #fff;
        font-size: 16px;
        padding: 5px 10px;
    }

    .audition_city_report_data .x_title .badge {
        font-size: 13px;
    }

    @media (max-width: 1200px) {
        .x_title h2 {
            width: 62%;
            font-size: 17px
        }

        .tile,
        .graph {
            zoom: 85%;
            height: inherit
        }
    }

    @media (max-width: 1270px) and (min-width: 192px) {
        .x_title h2 small {
            display: none
        }
    }
    .hide{
        display: none;
    }
</style>
@endif