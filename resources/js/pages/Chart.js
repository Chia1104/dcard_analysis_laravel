import React from 'react';
import ReactDOM from 'react-dom';

function Chart() {
    return (
        <div className="card">
            <div className="card-header">Chart Component</div>

            <div className="card-body">I'm an Chart component!</div>
        </div>
    );
}

export default Chart;

if (document.getElementById('chart')) {
    ReactDOM.render(<Chart />, document.getElementById('chart'));
}
