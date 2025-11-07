<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Survey</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 650px;
            width: 100%;
            padding: 48px;
            border-top: 4px solid #2c3e87;
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        h1 {
            color: #2c3e87;
            margin-bottom: 10px;
            font-size: 32px;
            text-align: center;
            font-weight: 700;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 36px;
            font-size: 15px;
            text-align: center;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #1f2937;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 15px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
            background: #fafafa;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #2c3e87;
            background: white;
            box-shadow: 0 0 0 3px rgba(44, 62, 135, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            max-height: 200px;
        }

        .char-count {
            font-size: 13px;
            color: #6b7280;
            text-align: right;
            margin-top: 4px;
        }

        .char-count.warning {
            color: #f59e0b;
        }

        .char-count.error {
            color: #e74c3c;
        }

        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        button {
            background: #2c3e87;
            color: white;
            padding: 16px 32px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 8px;
        }

        button:hover {
            background: #1e2d5f;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(44, 62, 135, 0.3);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 0 4px 8px rgba(44, 62, 135, 0.2);
        }

        .required {
            color: #e74c3c;
        }

        button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        button:disabled:hover {
            background: #9ca3af;
            transform: none;
            box-shadow: none;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s ease;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 16px;
            max-width: 450px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 40px;
            color: white;
        }

        .modal h2 {
            color: #2c3e87;
            font-size: 26px;
            margin-bottom: 12px;
        }

        .modal p {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .modal-button {
            background: #2c3e87;
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .modal-button:hover {
            background: #1e2d5f;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(44, 62, 135, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
            margin-left: 8px;
            vertical-align: middle;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('img/image.png') }}" alt="Tech Masters">
        </div>
        <h1>Anonymous Survey</h1>
        <p class="subtitle">Your feedback is important to us. All submissions are anonymous.</p>

        <form action="{{ route('survey.submit') }}" method="POST" id="surveyForm">
            @csrf

            <div class="form-group">
                <label for="addressing_to">
                    Who are you addressing this to? <span class="required">*</span>
                </label>
                <input
                    type="text"
                    id="addressing_to"
                    name="addressing_to"
                    value="{{ old('addressing_to') }}"
                    placeholder="e.g., Management, HR Department, Team Lead"
                    maxlength="255"
                    required
                >
                <div class="char-count" id="addressing_to_count">0/255</div>
                @error('addressing_to')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subject">
                    What are you addressing? <span class="required">*</span>
                </label>
                <input
                    type="text"
                    id="subject"
                    name="subject"
                    value="{{ old('subject') }}"
                    placeholder="e.g., Work Environment, Process Improvement, Communication"
                    maxlength="255"
                    required
                >
                <div class="char-count" id="subject_count">0/255</div>
                @error('subject')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="suggestions">
                    Your Suggestions <span class="required">*</span>
                </label>
                <textarea
                    id="suggestions"
                    name="suggestions"
                    placeholder="Please share your thoughts, suggestions, or feedback..."
                    maxlength="255"
                    required
                >{{ old('suggestions') }}</textarea>
                <div class="char-count" id="suggestions_count">0/255</div>
                @error('suggestions')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" id="submitBtn">
                <span id="btnText">Submit Survey</span>
            </button>
        </form>
    </div>

    <!-- Success Modal -->
    <div class="modal" id="successModal">
        <div class="modal-content">
            <div class="modal-icon">✓</div>
            <h2>Thank You!</h2>
            <p>Your survey has been submitted successfully. We appreciate your feedback!</p>
            <button class="modal-button" onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
        // Character counting for all fields
        const fields = ['addressing_to', 'subject', 'suggestions'];

        fields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            const counter = document.getElementById(fieldId + '_count');

            // Update counter on initial load if there's old value
            if (field.value) {
                updateCounter(field, counter);
            }

            field.addEventListener('input', () => updateCounter(field, counter));
        });

        function updateCounter(field, counter) {
            const length = field.value.length;
            const maxLength = 255;
            counter.textContent = `${length}/${maxLength}`;

            // Add warning/error class based on character count
            counter.classList.remove('warning', 'error');
            if (length > maxLength * 0.9) {
                counter.classList.add('warning');
            }
            if (length === maxLength) {
                counter.classList.add('error');
            }
        }

        // Form submission handling
        const form = document.getElementById('surveyForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        let isSubmitting = false;

        form.addEventListener('submit', function(e) {
            // Prevent double submission
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }

            // Check if form is valid
            if (!form.checkValidity()) {
                return; // Let HTML5 validation handle it
            }

            // Set submitting state
            isSubmitting = true;

            // Disable button and show loading state
            submitBtn.disabled = true;
            btnText.innerHTML = 'Submitting<span class="loading-spinner"></span>';
        });

        // Show modal if there's a success message
        @if(session('success'))
            window.addEventListener('DOMContentLoaded', () => {
                showModal();
            });
        @endif

        function showModal() {
            document.getElementById('successModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('successModal').classList.remove('active');
            // Reset form
            document.getElementById('surveyForm').reset();
            // Reset character counters
            fields.forEach(fieldId => {
                const counter = document.getElementById(fieldId + '_count');
                counter.textContent = '0/255';
                counter.classList.remove('warning', 'error');
            });
            // Reset submit button state
            isSubmitting = false;
            submitBtn.disabled = false;
            btnText.innerHTML = 'Submit Survey';
        }

        // Close modal when clicking outside
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Re-enable button if there are validation errors on page load
        window.addEventListener('DOMContentLoaded', () => {
            @if($errors->any())
                isSubmitting = false;
                submitBtn.disabled = false;
                btnText.innerHTML = 'Submit Survey';
            @endif
        });
    </script>
</body>
</html>
