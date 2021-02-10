@extends('layouts.adminPanLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product</a> </div>
            <br>
            <h1>Add a product</h1>

        </div>
        <div class="container-fluid"><hr><br><br>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add a new product</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{url('/admin/add-product')}}" name="add_product" id="add_product" novalidate="novalidate">{{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Name of category: </label>
                                    <div class="controls">
                                        <input type="text" name="product_name" id="product_name">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Category Level: </label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px;">
                                            <option value="0">What is this product types category?</option>
                                            //This foreach statement will return all the categories
                                            //with a parent id of 0
                                            //which is set in the $levels variable created in the add category function
                                            @foreach($levels as $val)
                                                <option value="{{$val->id}}">{{$val -> name}}</option>
                                            @endforeach
                                            //it will then return the name associated to the parent id,
                                            //within the dropdown selectable list.
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Description: </label>
                                    <div class="controls">
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL: </label>
                                    <div class="controls">
                                        <input type="text" name="url" id="url">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Create product" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
