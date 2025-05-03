export function startRover(payload) {
  return fetch(`http://localhost:8000/api/rover/start`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload),
  }).then(r => r.json())

}

export async function getRoverStatus() {
  const res = await fetch(`http://localhost:8000/api/rover/status`);
  if (!res.ok) throw new Error(`Status request failed: ${res.status}`);
  return res.json();
}

export async function executeCommands(commands) {
  const res = await fetch(`http://localhost:8000/api/rover/execute_commands`, {
    method: 'POST',
    headers: { 'Content-Type':'application/json' },
    body: JSON.stringify({ commands }),
      });
    if (!res.ok) throw new Error(`Command execution failed: ${res.status}`);
    return res.json();
  }