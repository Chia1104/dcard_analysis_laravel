import React from 'react';
import ReactDOM from 'react-dom';

function Post() {
    return (
        <div className="card">
            <div className="card-header">Post Component</div>

            <div className="card-body">I'm an Post component!</div>
        </div>
    );
}

export default Post;

if (document.getElementById('post')) {
    ReactDOM.render(<Post />, document.getElementById('post'));
}
