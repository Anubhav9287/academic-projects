@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">DASHBOARD: <strong>{{$user->subdivision_name}}</strong> Building: <strong>{{$user->building_no}}</strong> OWNER</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-3 p-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="116" height="116" fill="currentColor" class="bi bi-emoji-sunglasses" viewBox="0 0 16 16">
                                <path d="M4.968 9.75a.5.5 0 1 0-.866.5A4.498 4.498 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.498 3.498 0 0 1 8 11.5a3.498 3.498 0 0 1-3.032-1.75zM7 5.116V5a1 1 0 0 0-1-1H3.28a1 1 0 0 0-.97 1.243l.311 1.242A2 2 0 0 0 4.561 8H5a2 2 0 0 0 1.994-1.839A2.99 2.99 0 0 1 8 6c.393 0 .74.064 1.006.161A2 2 0 0 0 11 8h.438a2 2 0 0 0 1.94-1.515l.311-1.242A1 1 0 0 0 12.72 4H10a1 1 0 0 0-1 1v.116A4.22 4.22 0 0 0 8 5c-.35 0-.69.04-1 .116z" />
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-1 0A7 7 0 1 0 1 8a7 7 0 0 0 14 0z" />
                            </svg>
                        </div>
                        <div class="col-9 p-5">
                            <div>
                                <h1>Welcome: {{$user->username}}</h1>
                            </div>
                            <div>
                                <div><strong>Enrolled As:</strong> {{$user->signup}}</div>
                                <div><strong>Email:</strong> {{$user->email}}</div>
                                <div><strong>Contact:</strong> {{$user->contactnumber}}</div>
                            </div>
                        </div>
                        @if($user->status =='active')
                        <div class='col-12'>
                            <div class="alert alert-primary" role="alert">
                                <strong>{{$user->subdivision_name}}</strong> -> Building: <strong>{{$user->building_no}}</strong>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="card-deck">
                                <div class="card border-info mb-3" style="max-width: 18rem;">
                                    <div class="card-header">G-FLOOR</div>
                                    <div class="card-body text-info">
                                        <h6 class="card-title">Number of Occupant: {{count($f1)}}</h6>
                                        <hr>
                                        <p class="card-text">Gas: ${{$total_elec_f1}}</p>
                                        <p class="card-text">Water: ${{$total_water_f1}}</p>
                                        <p class="card-text">Electricity: ${{$total_elec_f1}}</p>
                                    </div>
                                </div>
                                <div class="card border-info mb-3" style="max-width: 18rem;">
                                    <div class="card-header">1st-FLOOR</div>
                                    <div class="card-body text-info">
                                        <h6 class="card-title">Number of Occupant: {{count($f2)}}</h6>
                                        <hr>
                                        <p class="card-text">Gas: ${{$total_elec_f2}}</p>
                                        <p class="card-text">Water: ${{$total_water_f2}}</p>
                                        <p class="card-text">Electricity: ${{$total_elec_f2}}</p>
                                    </div>
                                </div>
                                <div class="card border-info mb-3" style="max-width: 18rem;">
                                    <div class="card-header">2nd-FLOOR</div>
                                    <div class="card-body text-info">
                                        <h6 class="card-title">Number of Occupant: {{count($f3)}}</h6>
                                        <hr>
                                        <p class="card-text">Gas: ${{$total_elec_f3}}</p>
                                        <p class="card-text">Water: ${{$total_water_f3}}</p>
                                        <p class="card-text">Electricity: ${{$total_elec_f3}}</p>
                                    </div>
                                </div>
                                <div class="card border-info mb-3" style="max-width: 18rem;">
                                    <div class="card-header">3rd-FLOOR</div>
                                    <div class="card-body text-info">
                                        <h6 class="card-title">Number of Occupant: {{count($f4)}}</h6>
                                        <hr>
                                        <p class="card-text">Gas: ${{$total_elec_f4}}</p>
                                        <p class="card-text">Water: ${{$total_water_f4}}</p>
                                        <p class="card-text">Electricity: ${{$total_elec_f4}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" pt-2">
                                <div class="card">
                                    <div class="card-header">
                                        FOR YOUR BUILDING BELOW IS THE TOTAL AMOUNT:
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary">${{$amount}}</a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class='col-12'>
                                <div class="alert alert-warning" role="alert">
                                    <strong>YOUR ACCOUNT IS NOT ACTIVE. PLEASE CONTACT OUR TEAM.</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <button type="button" onclick="exportF(this)" class="btn  btn-outline-info btn-lg btn-block">Click here to export the report</button>
                    <!-- <a id="downloadLink" onclick="exportF(this)">Export to excel</a> -->
                    <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gas</th>
                        <th scope="col">Water</th>
                        <th scope="col">Electricity</th>
                        <th scope="col">Internet</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>   
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ((array)$t_u as $p) : ?>
                        <tr>
                        <td><?php echo $i;
$i++; ?></td>
                        <td>{{$p['name']}}</td>
                        <td>{{$p['email']}}</td>
                        <td>{{$p['gas']}}</td>
                        <td>{{$p['water']}}</td>
                        <td>{{$p['electricity']}}</td>
                        <td>{{$p['internet']}}</td>
                        <td>{{$p['total']}}</td>
                        
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
                </div>
                
            </div>
        </div>
        <!-- <div id="after-login" >
                    <h3 id="me">Active Users</h3>
                <div id="user-list" class="user-list"></div>
        </div> -->
        <div class="card border-success mb-3" style="max-width: 18rem;" id="after-login"> 
            <h4 class="card-header">ONLINE USERS</h4>
            <div class="card-body">
                <h5 class="card-title"> <div id="user-list" class="user-list"></div></h5>
            </div>
            </div>
    </div>
    
</div>
@endsection

                @push('head')
            <!-- Styles -->
            <!-- Scripts -->
            <script src="http://localhost:3000/socket.io/socket.io.js"></script>
            <script>
                var user_data = {!!json_encode((array) auth()->user()->id) !!};
                // console.log("User Data");
                console.log(user_data[0]);

                let loggedInUser = {
                    user_id: user_data[0]
                };
                // const socket = io("http://localhost:3000");
                var socket = io('http://localhost:3000', {
                    transports: ['websocket', 'polling', 'flashsocket']
                });
                // const login = () => {
                //     let username = $('#login_name').val();
                //     let password = $('#login_pass').val();
                //     socket.emit('loggedin', {
                //         user_id: loggedInUser.user_id,
                //         username: "RandomXYZ"
                //     });
                //     $('#login').hide();
                //     $('#after-login').show();
                // }
                socket.emit('loggedin', {
                    user_id: loggedInUser.user_id,
                    user_full_name: "Building User"
                });
                const sendMyMessage = (chatWidowId, fromUser, message) => {
                    let meClass = loggedInUser.user_id == fromUser.user_id ? 'me' : '';

                    $('#after-login').find(`#${chatWidowId} .body`).append(`
            <div class="chat-text ${meClass}">
                <div class="userPhoto">
                    <img src="images/avatar.jpg" />
                </div>
                <div>
                    <span class="message">${message}<span>
                </div>
            </div>
    `);
                }

                const sendMessage = (room) => {
                    let message = $('#' + room).find('.messageText').val();
                    $('#' + room).find('.messageText').val('');
                    socket.emit('message', {
                        room: room,
                        message: message,
                        from: loggedInUser
                    });
                    sendMyMessage(room, loggedInUser, message)
                }

                const openChatWindow = (room) => {
                    if ($(`#${room}`).length === 0) {
                        $('#after-login').append(`
                <div class="chat-window" id="${room}">
                    <div class="body"></div>
                    <div class="footer">
                        <input type="text" style="padding: 12px;" class="messageText"/><button style="width: 65px;height: 28px;margin-left: 5px;" onclick="sendMessage('${room}')">GO</button>
                    </div>
                </div>
        `)
                    }
                }

                const createRoom = (id) => {
                    let room = Date.now() + Math.random();
                    room = room.toString().replace(".", "_");
                    socket.emit('create', {
                        room: room,
                        userId: loggedInUser.userId,
                        withUserId: id
                    });
                    openChatWindow(room);
                }

                socket.on('updateUserList', function(userList) {
                    $('#user-list').html('<ul></ul>');
                    userList.forEach(item => {
                        if (loggedInUser.user_id != item.user_id) {
                            $('#user-list ul').append(
                                `<li data-id="${item.user_id}" onclick="createRoom('${item.user_id}')">${item.user_full_name}</li>`
                            )
                        }
                    });

                });

                socket.on('invite', function(data) {
                    socket.emit("joinRoom", data)
                });

                socket.on('message', function(msg) {
                    //If chat window not opened with this roomId, open it
                    if (!$('#after-login').find(`#${msg.room}`).length) {
                        openChatWindow(msg.room)
                    }
                    sendMyMessage(msg.room, msg.from, msg.message)
                });
   
            $(document).ready(function() {
                var table = $('#example').DataTable( {
                    lengthChange: false,
                    buttons: [ 'copy', 'excel', 'csv', 'pdf' ]
                } );
            
                table.buttons().container()
                    .appendTo( '#example_wrapper .col-md-6:eq(0)' );
            } );
    </script>
   
    @endpush

    @push('script')
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

    <script>function exportF() {
  let table = document.getElementsByTagName("table"); // you can use document.getElementById('tableId') as well by providing id to the table tag
  TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
    name: `export.xlsx`, // fileName you could use any name
    sheet: {
      name: 'Sheet 1' // sheetName
    }
  });
}</script>
    @endpush