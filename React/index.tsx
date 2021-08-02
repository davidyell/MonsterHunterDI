import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import Monsters from './Monsters/Monsters';
import Monster from './Monsters/Monster';

ReactDOM.render(
  <React.StrictMode>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="/bootstrap/css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />

    <BrowserRouter>
      <Switch>
        <Route path="/react/monsters/view/:id">
          <Monster />
        </Route>
        <Route path="/react/index.html">
          <Monsters />
        </Route>
      </Switch>
    </BrowserRouter>

  </React.StrictMode>,
  document.getElementById('app'),
);
