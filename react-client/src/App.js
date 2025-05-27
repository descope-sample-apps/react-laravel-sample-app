import { useCallback } from 'react'
 
import { useDescope, useSession, useUser } from '@descope/react-sdk'
import { Descope } from '@descope/react-sdk'
import { getSessionToken } from '@descope/react-sdk';
import { useState } from 'react';
import './App.css'
 
const App = () => {
  const { isAuthenticated, isSessionLoading } = useSession()
  const { user, isUserLoading } = useUser()
  const { logout } = useDescope()
  const [data, setData] = useState("");
 
  const signIn = () => {
    const sessionToken = getSessionToken();
 
    try {
      fetch('https://react-laravel-sample-app-main-5zjdeg.laravel.cloud/verify', {
        method: 'GET',
        headers: {
          Accept: '*/*',
          Authorization: 'Bearer ' + sessionToken,
        }
      })
      .then(async (response) => {
        const jsonData = await response.json();
        setData(jsonData.message);
      })
    }
    catch (error) {
      console.log('Error:', error);
    }
  }
 
  const handleLogout = useCallback(() => {
    logout()
    setData("");
  }, [logout])
 
  return <>
    {!isAuthenticated &&
      (
        <Descope
          flowId="sign-up-or-in"
          onSuccess={(e) => console.log(e.detail.user)}
          onError={(e) => console.log('Could not log in!')}
        />
      )
    }
 
    {
      (isSessionLoading || isUserLoading) && <p className='home'>Loading...</p>
    }
 
    {!isUserLoading && isAuthenticated &&
      (
        <div class="home">
            <h1>PHP Sample App</h1>
            <button onClick={signIn}>Validate Session</button>
            <button onClick={handleLogout}>Logout</button>
            <h2>{data}</h2>
        </div>
      )
    }
  </>;
}
 
export default App;