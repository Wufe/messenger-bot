import * as React from 'react';

export interface AppProps {
	compiler: string;
	framework: string;
}

class App extends React.Component<AppProps, {}>{
	render(){
		return (
			<h1>
				Alastor!
			</h1>
		);
	}
}

export default App;