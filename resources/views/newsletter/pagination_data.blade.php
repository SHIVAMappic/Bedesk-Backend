  <div class="table-responsive">
                  <table id="recent-purchases-listing" class="table">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Title</th>                     
                      <th>Add Date</th>                                                                 
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allNewsletter)
                    <?php  $i = 1; ?>
                      @foreach($allNewsletter as $newsletter)
                        <tr  id="{{$newsletter->id}}">
                          <td><?php echo $i;?></td>
                          <td>{{$newsletter->title}}</td>                          
                          <td>{{$newsletter->add_date}}</td>                                                                                
                          <td>
                            <a href="{{url('admin/newsletter/viewNewsletter',$newsletter->id)}}" class="btn btn-info  "> <i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('admin/newsletter/editNewsletter',$newsletter->id)}}" class="btn btn-success "><i class="fa fa-edit"></i></a>
                            <button type="button"  onclick="deleteRecord(this)"
                                data-url="{{url('admin/newsletter/editNewsletter')}}" data-token="{{ csrf_token() }}" data-id="{{$newsletter->id}}" class="btn btn-danger "><i class="fa fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <?php  $i++;?>
                      @endforeach
                    @endif  
                  </tbody>
                </table>
                <div> {!! $allNewsletter->links() !!}</div>
              </div>