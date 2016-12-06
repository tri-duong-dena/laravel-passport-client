import React from 'react';
import ReactDOM from 'react-dom';
import Counter from './Counter';

// sample render
function tick() {
  const element = (
    <div>
      <h1>Hello, world!</h1>
      <h2>It is {new Date().toLocaleTimeString()}.</h2>
    </div>
  );
  ReactDOM.render(
    element,
    document.getElementById('rootelement')
  );
}

function Welcome(props) {
  return <h1>Hello, {props.name}</h1>;
}

function App2(){
	return(
		<div>
			<Welcome name="sample 1"/>
			<Welcome name="sample 2"/>
		</div>
);
}
ReactDOM.render(
  <App2/>,
  document.getElementById('root2')
);

setInterval(tick, 1000);

// sample render counter
ReactDOM.render(<Counter />,document.getElementById('reacroot'));


