  <div class="table-responsive">
                  <table id="recent-purchases-listing" class="table">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Add Date</th>                                                                
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allSubscription)
                    <?php  $i = 1; ?>
                      @foreach($allSubscription as $subscription)
                        <tr  id="{{$subscription->id}}">
                          <td><?php echo $i;?></td>
                          <td>{{$subscription->title}}</td>
                          <td>{{$subscription->price}}</td>
                          <td>{{$subscription->add_date}}</td>                                                                              
                          <td>
                            <a href="{{url('admin/subscription/viewSubscription',$subscription->id)}}" class="btn btn-info  "> <i class="fa fa-eye" aria-hidden="true"></i></a>
                          <!--  <a href="{{url('admin/subscription/editSubscription',$subscription->id)}}" class="btn btn-success "><i class="fa fa-edit"></i></a>--->
                            <button type="button"  onclick="deleteRecord(this)"
                                data-url="{{url('admin/subscription/editSubscription')}}" data-token="{{ csrf_token() }}" data-id="{{$subscription->id}}" class="btn btn-danger "><i class="fa fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <?php  $i++;?>
                      @endforeach
                    @endif  
                  </tbody>
                </table>
                <div> {!! $allSubscription->links() !!}</div>
              </div>