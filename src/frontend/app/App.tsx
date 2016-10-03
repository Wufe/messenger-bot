import * as React from 'react';

export interface AppProps {
	children: any;
}

class App extends React.Component<AppProps, {}>{
	render(){
		return (
			<div>
				<h1>
					Alastor.
				</h1>
				{this.props.children}
			</div>
		);
	}
}

export default App;
