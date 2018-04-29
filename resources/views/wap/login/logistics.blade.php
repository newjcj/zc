@extends('wap.master.index')
@section('title','订单详情')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>

    <script src="/wap/js/common.js"></script>
    <script src="/wap/js/Popt.js"></script>
    <script src="/wap/js/cityJson.js"></script>
    <script src="/wap/js/citySet.js"></script>

    <style type="text/css">
        ._citys {width:100%; height:100%;display: inline-block; position: relative;}
        ._citys span {color: #56b4f8; height: 15px; width: 15px; line-height: 15px; text-align: center; border-radius: 3px; position: absolute; right: 1em; top: 10px; border: 1px solid #56b4f8; cursor: pointer;}
        ._citys0 {width: 100%; height: 34px; display: inline-block; border-bottom: 2px solid #56b4f8; padding: 0; margin: 0;}
        ._citys0 li {float:left; height:34px;line-height: 34px;overflow:hidden; font-size: 15px; color: #888; width: 80px; text-align: center; cursor: pointer; }
        .citySel {background-color: #56b4f8; color: #fff !important;}
        ._citys1 {width: 100%;height:80%; display: inline-block; padding: 10px 0; overflow: auto;}
        ._citys1 a {height: 35px; display: block; color: #666; padding-left: 6px; margin-top: 3px; line-height: 35px; cursor: pointer; font-size: 13px; overflow: hidden;}
        ._citys1 a:hover { color: #fff; background-color: #56b4f8;}
        .ui-content{border: 1px solid #EDEDED;}
        li{list-style-type: none;}
    </style>

    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>

    {{--多选框--}}
    <style>
        /* why not try uncommenting
            /* one of these lovely colors? */
        /* if you are experiencing the
            /* radios and the button being
            /* slightly misaligned (and moving
            /* by 1px(ish)) then resize your browser.
            /* Codepen's frames seem to be the
            /* culprit */
        label.chkbox {
            display: inline-block;
            *display: inline;
            *zoom: 1;
            position: relative;
            z-index: 2;
            vertical-align: top;
            width: 48px;
            height: 16px;
            border-radius: 5px;
            margin: 0 5px 5px 0;
            padding: 7px 10px;
            cursor: pointer;
            overflow: hidden;
            background-color: #cfcfcf;
            color: white;
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1);
            -webkit-transition: background-color 0.4s ease;
            -moz-transition: background-color 0.4s ease;
            -ms-transition: background-color 0.4s ease;
            -o-transition: background-color 0.4s ease;
            transition: background-color 0.4s ease;
        }
        label.chkbox .yes,
        label.chkbox .no {
            position: absolute;
            right: 8px;
            text-indent: -999em;
            height: 20px;
            width: 20px;
            background-repeat: no-repeat;
        }
        label.chkbox .no {
            margin-top: -2px;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUM1RDY0NDE2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUM1RDY0NDI2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxQzVENjQzRjZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxQzVENjQ0MDZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ppxje+AAAAF/SURBVHjaYvz//z8DNQETA5XB4DeQBV2AkZERRDEDMRsQgwL4FxD/Q3IASByk6DcQ/0GPAxYsloAUcwOxGJT/Gog/Q9k8QCwKNfgNEH9Esgynl0EGcty7d6/n6NGjZUC2NBDzQQ2T2r59ezZQrjs/P18MqhYVgJyMjEGKLl26ZPcfCoAG9AHF9IBYG8SGid+8eTMApBZDPxYDwWH46dOnhTDNGzdunFxeXp4L43/8+HERLLiINRAEWN+9e7cEZMDPnz+/gDCI/ePHj0t79uwRx+lDfAYmJyfrfPjw4SbMZSB2QkKCLjSmsRqIKx2Ckg3/gwcPRP/9+wdXA2I/fPgQFBmCOFII9kiBxqre/fv3D4Fc9ufPn48gDGIDg+G2m5ubHVBegNhIAblIDGjYephXnzx5Eg+KeZihwGSzAahGAuQTYgxkvHr1qi3MsDdv3uRBLWECsdGSDROxkcL0/fv36q9fv2ahJX4mYJKJAsb43HPnzoliCzLG0fKQYgAQYAAqwK1lMkf1cgAAAABJRU5ErkJggg==');
        }
        label.chkbox .yes {
            margin-top: -1px;
            left: 8px;
            background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIFdpbmRvd3MiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUM1RDY0M0Q2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUM1RDY0M0U2RDhGMTFFMjgxM0ZCNTVDNUM0QjlEREIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxQzVENjQzQjZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxQzVENjQzQzZEOEYxMUUyODEzRkI1NUM1QzRCOUREQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PrTLJacAAAGWSURBVHjaYvz//z8DCDAyMjKQAECKmYAYpPkfzAwQYGEgHTADMTcQcwHxTyD+AsS/YZJMJBrGCDVMds6cOeH+/v5qQDY7igqQc5GdTABwALHyuXPnVgD1/H/16tVOIJ8HZgbYHBIMBPlGDOiy/P9Q8PHjxy1AMVZyDAR5lQeIdb58+fIcZNifP38+Hj16VAckh89AkCvYoBg5fEF8OaABs2Cue/nyZRNMDS4D4QEOxApAzA/VAMLCOTk5ATDDvn//fhk5MnAZCA6jDRs2VG/fvr0PyNYCYl6oVzWeP39+Dmbg7du3/aEOwGsg46pVq4xhmo4cOTIbKAZKFkq7du3qgYkDY3YKevrFGYZr166V/Pv37weY5pqamkwLCwu/X79+fYZFxPLly6XQYwxfpDDeu3fPD2bg58+fXwC9dwzGv3//fiK2zEAo2TC9fv268T8a+Pr162FobDOQaiAIsALT2yaYYchpjlwDGfbs2SMONOgBNEfU4cv3ROeUJ0+eCP/48cMNl8uwGchIQsHAQGyGH2EGAgQYANGzvfuxqx8aAAAAAElFTkSuQmCC');
        }
        label.chkbox .toggle {
            content: " ";
            width: 30px;
            height: 24px;
            border-radius: 3px;
            display: block;
            position: absolute;
            overflow: hidden;
            z-index: 3;
            left: 3px;
            top: 3px;
            background: transparent;
            box-shadow: 0 2px 5px 1px rgba(0, 0, 0, 0.2), 0 0 1px #ffffff inset;
            transform: translateX(1px);
            -webkit-transition: -webkit-transform 0.3s ease;
            -moz-transition: -moz-transform 0.3s ease;
            -ms-transition: -ms-transform 0.3s ease;
            -o-transition: -o-transform 0.3s ease;
            transition: transform 0.3s ease;
            background-image: linear-gradient(#ffffff 0%, #e7e7e7 100%);
        }
        label.chkbox .toggle:after {
            content: " ";
            width: 16px;
            height: 16px;
            position: absolute;
            left: 7px;
            top: 4px;
            border-radius: 100%;
            background-image: linear-gradient(#dddddd 0%, #ffffff 100%);
            box-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
        }
        label.chkbox.on {
            background-color: #05abe0;
        }
        label.chkbox.on .toggle {
            transform: translateX(31px);
        }
        label.chkbox.focus {
            outline: 0;
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1), 0 0 8px #52a8ec, 0 0 1px 1px rgba(0, 0, 0, 0.75) inset;
        }



        input[type=checkbox].replaced,
        input[type=radio].replaced {
            position: absolute;
            left: -9999em;
        }

        .wrapper {
            width: 270px;
            margin: 30px auto;
        }


    </style>

    <script src="/wap/js/prefixfree.min.js"></script>
@endsection

@section('content')
    <header id="header" style="">
        <div class="topbar">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <h1 class="page_title">订单跟踪</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div class="vip-club border_top_bottom vip-account">
        <div class="vip-club border_top_bottom">
            <div class="vip-club-title border_bottom">
                运单号：{{$wl['LogisticCode']}}<br>
                国内承运人：{{$yc}}<br>
                国内承运人电话：95554
                {{--{{$wl['Traces'][0]}}--}}
            </div>

            @foreach($wl1 as $item)
                <div class="vip-club-title border_bottom">
                    <font id="col_{{$i}}">{{$item['AcceptStation']}}<br>
                        {{$item['AcceptTime']}}</font>
                </div>
                <span style=" display: none;">{{$i++}}</span>
            @endforeach
        </div>
    </div>
    <br><br><br>
    <script src='/wap/js/jquery.js'></script>
    <script src="/wap/js/index.js"></script>
@endsection

@section('script')
    <script type="text/javascript">
     $(function () {
        $("#col_0").css({color:"#F30", "font-weight":"600"});
     });



    </script>
@endsection