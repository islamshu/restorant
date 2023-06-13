
        @foreach ($orders as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>

                <td>
                  <span class="timeHandlerLoading" data-time-start="{{ $item->created_at }}"></span>

                </td>
                             
        <td>
                    {{ $item->name }} <br>
                    <a class="text-secondry" href="tel:{{ $item->phone }}">{{ $item->phone }}</a>
                    
                  </td>
                  <td>
                    {{ $item->note }}
                  </td>
                  <td>
                    <select class="form-control btn btn-{{ get_button_status($item->status) }}" id="selected_{{ $item->id }}" onchange="changestatus({{ $item->id }})">
                        <option value="2" @if($item->status == 2) selected @endif>Watting</option>
                        <option value="1" @if($item->status == 1) selected @endif>Done</option>
                    </select>
                    {{-- <button class="btn btn-{{get_button_status($item->status)  }}" selected>{{ get_status($item->status) }}</button>   --}}
                  </td>
                  <td>
                    {{ $item->table_type }}
                  </td>
                  
                  <td>
                    {{ $item->guest }}
                  </td>
                  <td>
                    {{ $item->created_at }}
                  </td>
                  <td>
                    <a href="tel:{{ $item->phone }}"><i class="fa fa-phone-square fa-3x" aria-hidden="true"></i>
                    </a>
                  </td>
                  



            </tr>
        @endforeach


