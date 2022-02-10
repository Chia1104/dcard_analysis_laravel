import React from 'react';
import ReactDOM from 'react-dom';

function Chat() {
    return (
        <div className="card">
            <div className="card-header">Chat Component</div>

            <div className="card-body">I'm an Chat component!</div>
        </div>
    );
}

export default Chat;

if (document.getElementById('chat')) {
    ReactDOM.render(<Chat />, document.getElementById('chat'));
}
