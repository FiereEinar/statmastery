<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Quiz Report</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 40px;
    }

    h2 {
      font-size: 24px;
      margin-bottom: 5px;
    }

    p.meta {
      font-size: 12px;
      color: #555;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 14px;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f0f0f0;
    }

    tr:nth-child(even) {
      background-color: #fafafa;
    }

    .font-bold {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h2>{{ $currentCourse->title }}, {{ $quiz->title }}</h2>
  <p class="meta">Created at: {{ $currentCourse->created_at->format('F j, Y g:i A') }}</p>

  <table>
    <thead>
      <tr>
        <th>Learner</th>
        <th>Submitted At</th>
        <th>Score</th>
        <th>Percentage</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($quiz->submissions as $submission)
        @php
          $percentage = $quiz->contentQuizzes->count() > 0
            ? $submission->score / $quiz->contentQuizzes->count() * 100
            : 0;
        @endphp
        <tr>
          <td class="font-bold">{{ $submission->user->name }}</td>
          <td>{{ $submission->created_at->format('F j, Y g:i A') }}</td>
          <td>{{ $submission->score }}/{{ $quiz->contentQuizzes->count() }}</td>
          <td>%{{ number_format($percentage, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
