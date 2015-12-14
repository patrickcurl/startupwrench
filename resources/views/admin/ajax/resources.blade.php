


<div id="resources" class="container-fluid resources">
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Resources</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead><tr>
                  <th>ID</th>
                  <th>Resource</th>
                  <th>Description</th>
                  <th>Content</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resources as $r)
                <tr>
                <td>{{ $r->id }}</td>
                <td>
                	Title: <a href="#" data-type="text" data-pk="{{ $r->id }}" data-url="/admin/resources" data-title="enter resource name" data-name="name" class="resource-item">{{ $r->name }}</a><br /> 
                	Slug: <a href="#" data-type="text" data-pk="{{ $r->id }}" data-url="/admin/resources" data-title="enter resource name" data-name="slug" class="resource-item">{{ $r->slug }}</a><br />
                	Url: {{ $r->domain }}<br />
                	Tagline: {{  $r->representation }}<br />
                	Facebook: {{ $r->facebook }}<br />
                	Twitter: {{ $r->twitter }}<br />
                	Featured Image: {{ $r->featured_image }}<br />
                	Logo: {{ $r->logo }}<br />
                </td>
                <td>
                	{{ $r->description }}
                </td>
                <td>{!! $r->content !!}</td>
                </tr>
                @endforeach
              
              </tbody></table>
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