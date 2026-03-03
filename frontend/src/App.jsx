import ChatBox from "./components/ChatBox";

export default function App() {
  const userId = 1; // temporary session user id for testing
  const toiId = 2;  // chat partner id

  return (
    <div className="min-h-screen bg-gray-100 p-6">
      <h1 className="text-2xl font-bold mb-4">TYZ Chat</h1>
      <ChatBox toiId={toiId} userId={userId} />
    </div>
  );
}
