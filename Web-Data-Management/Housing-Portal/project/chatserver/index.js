const http = require('http');
const express = require('express');
const socketio = require('socket.io');
const path = require('path');
const app = express();
const cors = require('cors');
const server = http.createServer(app);
const io = socketio(server);

app.use(cors());
app.options('*', cors());

app.use('/node_modules', express.static(path.join(__dirname, 'node_modules', )));

let clientSocketIds = [];
let connectedUsers= [];

const getSocketByUserId = (userId) =>{
    let socket = '';
    for(let i = 0; i<clientSocketIds.length; i++) {
        if(clientSocketIds[i].userId == userId) {
            socket = clientSocketIds[i].socket;
            break;
        }
    }
    return socket;
}

io.on('connection', socket => {
    console.log('conected');
    socket.on('disconnect', () => {
        console.log("disconnected")
        connectedUsers = connectedUsers.filter(item => item.socketId != socket.id);
        io.emit('updateUserList', connectedUsers)
    });

    socket.on('loggedin', function(user) {
        clientSocketIds.push({socket: socket, userId:  user.user_id});
        connectedUsers = connectedUsers.filter(item => item.user_id != user.user_id);
        connectedUsers.push({...user, socketId: socket.id})
        io.emit('updateUserList', connectedUsers)
    });

    socket.on('create', function(data) {
        console.log("create room")
        console.log(data);
        socket.join(data.room);
        let withSocket = getSocketByUserId(data.withUserId);
        socket.broadcast.to(withSocket.id).emit("invite",{room:data})
    });
    socket.on('joinRoom', function(data) {
        socket.join(data.room.room);
    });

    socket.on('message', function(data) {
        socket.broadcast.to(data.room).emit('message', data);
    })
});


const PORT = process.env.PORT || 3000;

// Running the server on PORT.
server.listen(PORT, () => console.log(`Server running on port ${PORT}`));