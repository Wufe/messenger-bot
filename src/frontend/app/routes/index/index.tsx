import * as React from 'react';

interface Props{
	children: any;
}
interface State{}

export default class Index extends React.Component<Props, State>{
	render(){
		return (
			<div>
				<span>Index Route</span>
			</div>
		);	
	}
}