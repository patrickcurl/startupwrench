<div id="resources" class="container-fluid resources">
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border" >
              <h3 class="box-title">Resource Links</h3>

              <div class="box-tools">
                
                <form action="{{ url('/admin/resource-links') }}" method="post"  class="form-inline">
                  {!! csrf_field() !!}
                  <div class="form-group">
                  <input type="text" id="search-input" name="query" class="form-control pull-right" placeholder="Search">
                  </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box box-solid">
            
            <!-- /.box-header -->
            <div class="box-body">
              <ul>
                @foreach($resources as $r)
                <li>
                  <a href="#" data-type="text" data-pk="{{ $r->id }}" data-url="/admin/resources" data-title="enter resource link" data-name="domain" class="resource-item">{{ $r->domain }}</a> | <a href="{{ $r->domain }}" style="margin-left:10px;" target="_blank"><i class="fa fa-link"></i></a>
                  @if($r->afflink)
                  <a href="{{ $r->afflink }}" style="margin-left:10px;"><i class="fa fa-external-link"></i></a>
                  
                  @endif
                  | Aff: <a href="#" data-type="text" data-pk="{{ $r->id }}" data-url="/admin/resources" data-title="enter aff link" data-name="afflink" class="resource-item">{{ $r->afflink }}</a>
                </li>
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {!! $resources->render() !!} 
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
</div>
