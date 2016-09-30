import * as React from 'react';

export interface AppProps {
	compiler: string;
	framework: string;
}

class App extends React.Component<AppProps, {}>{
	render(){
		return (
			<h1>
				Hello from {this.props.compiler} and {this.props.framework}!
			</h1>
		);
	}
}

export default App;