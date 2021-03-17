import React, { Component } from 'react';
import { View, Text } from 'react-native';
import Reguser from './reguser'
// import Readuser from './readuser';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
    };
  }

  render() {
    return (
      <View>
        <Text>Test</Text>
         <View>
          <Reguser />
        </View>
       {/* <View>
          <Readuser />
        </View> */}
      </View>
    );
  }
}

export default App;