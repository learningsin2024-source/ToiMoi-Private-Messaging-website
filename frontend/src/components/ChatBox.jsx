import { useState, useEffect, useRef } from "react";

export default function ChatBox({ toiId, userId }) {
  const [messages, setMessages] = useState([]);
  const [newMsg, setNewMsg] = useState("");
  const containerRef = useRef();

  useEffect(() => {
    const fetchMessages = async () => {
      const res = await fetch(`http://localhost/toimoi/src/get-messages.php?toi_id=${toiId}`, {
        credentials: "include",
      });
      const data = await res.json();
      setMessages(data);
      containerRef.current?.scrollTo(0, containerRef.current.scrollHeight);
    };

    fetchMessages();
    const interval = setInterval(fetchMessages, 3000);
    return () => clearInterval(interval);
  }, [toiId]);

  const sendMessage = async () => {
    if (!newMsg.trim()) return;

    await fetch("http://localhost/toimoi/src/send-message.php", {
      method: "POST",
      credentials: "include",
      body: new URLSearchParams({ receiver_id: toiId, message: newMsg }),
    });

    setNewMsg("");
  };

  return (
    <div className="flex flex-col h-[80vh] max-w-md mx-auto bg-white border rounded-lg shadow p-4">
      <div ref={containerRef} className="flex-1 overflow-y-auto space-y-2">
        {messages.map((msg) => (
          <div
            key={msg.ID}
            className={`p-2 rounded-xl max-w-xs ${
              msg.sender_id === userId ? "bg-blue-500 text-white self-end ml-auto" : "bg-gray-200 text-gray-800 self-start"
            }`}
          >
            {msg.message}
          </div>
        ))}
      </div>

      <div className="flex gap-2 mt-3">
        <input
          className="flex-1 border rounded-lg p-2"
          value={newMsg}
          onChange={(e) => setNewMsg(e.target.value)}
          placeholder="Type a message..."
          onKeyDown={(e) => e.key === "Enter" && sendMessage()}
        />
        <button onClick={sendMessage} className="bg-blue-600 text-white px-4 py-2 rounded-lg">
          Send
        </button>
      </div>
    </div>
  );
}
