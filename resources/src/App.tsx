import { Attributes, ComponentChildren, Ref, ComponentChild } from 'preact';
import { PureComponent } from 'preact/compat';

declare global {
  // tslint:disable-next-line: interface-name
  interface Window {
  }
}

class App extends PureComponent {
  render(props?: Readonly<Attributes & { children?: ComponentChildren; ref?: Ref<any> | undefined; }> | undefined, state?: Readonly<{}> | undefined, context?: any): ComponentChild {
    return (
        <div>Hello world</div>
    );
  }
}

export default App;