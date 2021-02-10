@extends('layouts.adminPanLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Categories</a> <a href="#" class="current">Edit Categories</a> </div>
            <br>
            <h1>Edit Category</h1>

        </div>
        <div class="container-fluid"><hr><br><br>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit existing category</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{url('/admin/edit-category/'.$categoryDetails->id)}}" name="edit_category" id="edit_category" novalidate="novalidate">{{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Name of category: </label>
                                    <div class="controls">
                                        <input type="text" name="category_name" id="category_name" value="{{$categoryDetails->name}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description: </label>
                                    <div class="controls">
                                        <textarea name="description" id="description">{{$categoryDetails->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL: </label>
                                    <div class="controls">
                                        <input type="text" name="url" id="url" value="{{$categoryDetails->url}}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Submit Changes" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
