import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div className="card">
            <div className="card-header">Example Component</div>

            <div className="card-body">I'm an example component!</div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
