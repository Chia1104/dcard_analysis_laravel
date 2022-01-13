import React from 'react';
import ReactDOM from 'react-dom';

function Home() {
    return (
        <div className="card">
            <div className="card-header">Home Component</div>

            <div className="card-body">I'm an Home component!</div>
        </div>
    );
}

export default Home;

if (document.getElementById('home')) {
    ReactDOM.render(<Home />, document.getElementById('home'));
}
