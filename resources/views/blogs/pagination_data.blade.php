  <div class="table-responsive">
                  <table id="recent-purchases-listing" class="table">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Title</th>
                      <th>Created By</th>
                      <th>Add Date</th>
                      <th>Category</th>                                             
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allBlogs)
                    <?php  $i = 1; ?>
                      @foreach($allBlogs as $blogs)
                        <tr  id="{{$blogs->id}}">
                          <td><?php echo $i;?></td>
                          <td>{{$blogs->title}}</td>
                          <td>{{$blogs->name}}</td>
                          <td>{{$blogs->add_date}}</td>
                          <td>{{$blogs->category_name}}</td>                                                        
                          <td>
                            <a href="{{url('admin/blogs/viewBlog',$blogs->id)}}" class="btn btn-info  "> <i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('admin/blogs/editBlog',$blogs->id)}}" class="btn btn-success "><i class="fa fa-edit"></i></a>
                            <button type="button"  onclick="deleteRecord(this)"
                                data-url="{{url('admin/blogs/editBlog')}}" data-token="{{ csrf_token() }}" data-id="{{$blogs->id}}" class="btn btn-danger "><i class="fa fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <?php  $i++;?>
                      @endforeach
                    @endif  
                  </tbody>
                </table>
                <div> {!! $allBlogs->links() !!}</div>
              </div>