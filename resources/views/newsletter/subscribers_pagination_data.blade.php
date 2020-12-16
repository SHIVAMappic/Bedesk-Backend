  <div class="table-responsive">
                  <table id="recent-purchases-listing" class="table">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Email Address</th>                    
                      <th>Add Date</th>                                                                
                      <!---<th>Action</th>--->
                    </tr>
                  </thead>
                  <tbody>
                    @if($allSubscribers)
                    <?php  $i = 1; ?>
                      @foreach($allSubscribers as $subscribers)
                        <tr  id="{{$subscribers->id}}">
                          <td><?php echo $i;?></td>
                          <td>{{$subscribers->email}}</td>                         
                          <td>{{$subscribers->add_date}}</td>                                                                              
                         
                        </tr>
                        <?php  $i++;?>
                      @endforeach
                    @endif  
                  </tbody>
                </table>
                <div> {!! $allSubscribers->links() !!}</div>
              </div>