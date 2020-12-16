  <div class="table-responsive">
                  <table id="recent-purchases-listing" class="table">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Add Date</th>
                      <th>Link</th>                                             
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($allAdsManager)
                    <?php  $i = 1; ?>
                      @foreach($allAdsManager as $ads)
                        <tr  id="{{$ads->id}}">
                          <td><?php echo $i;?></td>
                          <td>{{$ads->title}}</td>
                          <td>{{$ads->description}}</td>
                          <td>{{$ads->add_date}}</td>
                          <td>{{$ads->link}}</td>                                                        
                          <td>
                            <a href="{{url('admin/ads-manager/viewAds',$ads->id)}}" class="btn btn-info  "> <i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('admin/ads-manager/editAds',$ads->id)}}" class="btn btn-success "><i class="fa fa-edit"></i></a>
                            <button type="button"  onclick="deleteRecord(this)"
                                data-url="{{url('admin/ads-manager/editAds')}}" data-token="{{ csrf_token() }}" data-id="{{$ads->id}}" class="btn btn-danger "><i class="fa fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                        <?php  $i++;?>
                      @endforeach
                    @endif  
                  </tbody>
                </table>
                <div> {!! $allAdsManager->links() !!}</div>
              </div>